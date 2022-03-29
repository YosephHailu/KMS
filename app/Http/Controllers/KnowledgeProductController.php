<?php

namespace App\Http\Controllers;

use App\KnowledgeProduct;
use App\KnowledgeCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;

use App\Notifications\KnowledgeProduct as KnowledgeProductNotification;

class KnowledgeProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('checkPermission:view knowledge |  all')->only(['show']);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('viewKnowledge', knowledgeProduct::class);
        return view('knowledge.knowledge');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Authorize User Action
        $this->authorize('create', knowledgeProduct::class);
        return view('knowledge.manage_knowledge')->with('new', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Authorize User Action
        $this->authorize('create', knowledgeProduct::class);
        //
        $this->validate($request, [
            'title' => 'required|string',
            'directorate_id' => 'required|integer',
            'source' => 'required|string',
            'contact' => 'required|string',
            'keywords' => 'required|string',
            'knowledge_description' => 'required|string',
            'knowledge_category_id' => 'required|integer',
            'access_level_id' => 'required|integer'
        ]);

        $request->request->add(['user_id' => Auth::id()]);
        $request->request->add(['views' => 0]);
        $kmProduct = knowledgeProduct::create($request->all());

        return redirect('knowledge')->with('success', 'knowledge Product Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return \Illuminate\Http\Response
     */
    public function show($knowledgeProduct)
    {
        //Authorize User Action

        $knowledgeProduct = KnowledgeProduct::find($knowledgeProduct);
        // foreach(Auth::user()->directorate->user as $user)
        //     $user->notify(new Knowledge
        // ProductNotification($knowledgeProduct));
        $this->authorize('view', $knowledgeProduct);

        $knowledgeProduct->views++;
        $knowledgeProduct->save();
        return view('knowledge.knowledge_detail')->with('knowledge', $knowledgeProduct);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(knowledgeProduct $knowledgeProduct)
    {
        //
        //Authorize User Action
        $this->authorize('update', $knowledgeProduct);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, knowledgeProduct $knowledgeProduct)
    {
        //
        $this->authorize('update', $knowledgeProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($knowledgeProduct)
    {
        //Find knowledge product by id
        $knowledgeProduct = KnowledgeProduct::find($knowledgeProduct);

        //Authorize if logged in user is authorized to delete the knowledge product
        $this->authorize('delete', $knowledgeProduct);

        $knowledgeCategory = $knowledgeProduct->knowledgeCategory;
        $knowledge = KnowledgeCategory::firstOrCreate(['category' => 'KnowledgeProduct']);
        $sub_url = $knowledgeCategory->id == $knowledge->id ? $knowledgeProduct->knowledge->knowledgeCategory->category : "";

        foreach ($knowledgeProduct->attachments as $attachment) {
            if (Storage::exists('Attachment/' . $knowledgeCategory->category . '/' . $sub_url . '/' . $attachment->file_url))
                Storage::delete('Attachment/' . $knowledgeCategory->category . '/' . $sub_url . '/' . $attachment->file_url);
        }

        $knowledgeProduct->delete();

        return response()->json(['message' => 'Success']);
    }

    public function tableData()
    {
        //Select all knowledge products the logged in use is authorized to view
        $knowledgeProducts = knowledgeProduct::All()->filter(function ($knowledgeProduct) {
            return Auth::user()->can('view', $knowledgeProduct);
        });

        return Datatables::of($knowledgeProducts)->addColumn('directorate', function ($knowledge) {
            return $knowledge->directorate->name;
        })->addColumn('delete', function ($knowledge) {
            if (Auth::user()->can('delete', $knowledge) || $knowledge->user_id == Auth::Id())
                return '<a href="" onclick="deleteKnowledgeProduct(' . $knowledge->id . ')" id=' . $knowledge->id . ' class="text-danger"><i class="icon-trash"></i></a>';
            else
                return '';
        })->addColumn('open', function ($knowledge) {
            if($knowledge->approved)
                return '<a href="' . url('knowledge/' . $knowledge->id) . '"><i class="icon-checkmark-circle text-success"></i> </a>';
            return '<a href="' . url('knowledge/' . $knowledge->id) . '"><i class="icon-notification2 text-danger"></i> </a>';
        })->addColumn('category', function ($knowledge) {
            return $knowledge->knowledgeCategory->category;
        })->rawColumns(['delete', 'open'])->make(true);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(knowledgeProduct $knowledgeProduct)
    {
        //update knowledge product status
        $knowledgeProduct->approved = !$knowledgeProduct->approved;
        $knowledgeProduct->save();

        //Check and redirect based on approved status
        if($knowledgeProduct->approved){
            $message = "Knowledge product published";
            return redirect()->back()->with('success', $message);
        }else{
            $message = "Knowledge product unpublished";
            return redirect()->back()->with('error', $message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KnowledgeProduct  $knowledgeProduct
     * @return \Illuminate\Http\Response
     */
    public function approve()
    {
        //Get all knowledge product ids the authorized user can approve
        $knowledgeIds = KnowledgeProduct::All()->filter(function ($knowledge) {
            return Auth::user()->can('publish', $knowledge) && !$knowledge->approved;
        })->pluck('id');;

        //Select the knowledge based on the ids selected and paginate
        $knowledges = KnowledgeProduct::whereIn('id', $knowledgeIds)->paginate(20);

        return view('knowledge.approve')->with('knowledges', $knowledges);

    }

}
