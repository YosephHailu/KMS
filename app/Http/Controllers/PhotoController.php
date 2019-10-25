<?php

namespace App\Http\Controllers;

use App\Photo;
use App\knowledgeProduct;
use App\KnowledgeCategory;
use App\UserLog;
use Auth;
use App\Attachment;
use Illuminate\Support\Facades\Storage;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function __construct()
    {
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
        //Authorize User Action
        $this->authorize('viewKnowledge', KnowledgeProduct::class);

        return view('photo.photo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //Authorize User Action
        $this->authorize('create', KnowledgeProduct::class);

        return view('photo.manage_photo')->with('new', true);
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
        $this->authorize('create', KnowledgeProduct::class);

        $this->validate($request, [
            'title' => 'required|string',
            'directorate_id' => 'required|integer',
            'source' => 'required|string',
            'contact' => 'required|string',
            'keywords' => 'required|string',
            'knowledge_description' => 'required|string',
            'access_level_id' => 'required|integer',
            'event_date' => 'date'
        ]);

        $knowledgeCategory = KnowledgeCategory::firstOrCreate(['category' => 'Photo']);

        $request->request->add(['user_id' => Auth::id()]);
        $request->request->add(['approved' => false]);
        $request->request->add(['views' => 0]);
        $request->request->add(['knowledge_category_id' => $knowledgeCategory->id]);

        $knowledgeProduct = KnowledgeProduct::create($request->all());

        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        Photo::create($request->all());


        if ($request->hasFile('attachment')) {
            $count = count($request->file('attachment'));
            for ($i = 0; $i < $count; $i++) {
                //get file name with extension
                $fileNameWithExt = $request->file('attachment')[$i]->getClientOriginalName();
                //Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //File extension
                $extension = $request->file('attachment')[$i]->getClientOriginalExtension();
                //File name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload Image
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Photo/', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads' => 0, 'file_url' => $fileNameToStore]);
            }
        }

        UserLog::create([
            'operation' => 'create',
            'action' => 'Create Knowledge Product',
            'remark' => 'Register This "' . $knowledgeProduct->title . '" Photo Gallery',
            'affected_url' => 'search/detail/' . $knowledgeProduct->id,
            'affected_table' => 'photos',
            'user_id' => Auth::Id(),
        ]);

        return redirect('photo')->with('success', 'Photo Information Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //

        //Authorize User Action
        $this->authorize('view', $photo->knowledgeProduct);

        $photoProduct = KnowledgeProduct::find($photoProduct);
        return view('photo.photo_detail')->with('photo', $photoProduct);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //

        //Authorize User Action
        $this->authorize('update', $photo->knowledgeProduct);

        return view('photo.manage_photo')->with('new', false)->with('photo', $photo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //

        //Authorize User Action
        $this->authorize('update', $photo->knowledgeProduct);
        $this->validate($request, [
            'title' => 'required|string',
            'directorate_id' => 'required|integer',
            'source' => 'required|string',
            'contact' => 'required|string',
            'keywords' => 'required|string',
            'knowledge_description' => 'required|string',
            'access_level_id' => 'required|integer',
            'event_date' => 'date'
        ]);


        $knowledgeProduct = KnowledgeProduct::find($photo->knowledgeProduct->id);
        $knowledgeProduct->update($request->All());

        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        $photo->update($request->All());
        $photo->save();

        if ($request->hasFile('attachment')) {
            $count = count($request->file('attachment'));
            for ($i = 0; $i < $count; $i++) {
                //get file name with extension
                $fileNameWithExt = $request->file('attachment')[$i]->getClientOriginalName();
                //Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //File extension
                $extension = $request->file('attachment')[$i]->getClientOriginalExtension();
                //File name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload Image
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Photo/', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads' => 0, 'file_url' => $fileNameToStore]);
            }
        }
        
        UserLog::create([
            'operation' => 'update',
            'action' => 'Updated Knowledge Product',
            'remark' => 'Updated This "' . $knowledgeProduct->title . '" Photo Information',
            'affected_url' => 'search/detail/' . $knowledgeProduct->id,
            'affected_table' => 'photos',
            'user_id' => Auth::Id(),
        ]);
        return redirect('photo')->with('success', 'Photo Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //        
        //Authorize User Action
        //Authorize User
        $this->authorize('delete', $photo->knowledgeProduct);
        foreach ($photo->knowledgeProduct->attachments as $attachment) {
            if (Storage::exists('Attachment/' . $photo->knowledgeProduct->knowledgeCategory->category . '/' . $attachment->file_url))
                Storage::delete('Attachment/' . $photo->knowledgeProduct->knowledgeCategory->category . '/' . $attachment->file_url);
        }

        UserLog::create([
            'operation' => 'delete',
            'action' => 'Delete Knowledge Product',
            'remark' => 'Deleted This "' . $photo->knowledgeProduct->title . '" Photo Information',
            'affected_url' => 'search/detail/' . $photo->knowledgeProduct->id,
            'affected_table' => 'photos',
            'user_id' => Auth::Id(),
        ]);
        
        KnowledgeProduct::find($photo->knowledge_product_id)->delete();
        // $photo->delete();

        return response()->json(['message' => 'Success']);
    }

    public function tableData()
    {
        
        $photos = Photo::All()->filter(function ($photo) {
            return Auth::user()->can('view', $photo->knowledgeProduct);
        });

        return Datatables::of($photos)->addColumn('directorate', function ($photo) {
            return $photo->knowledgeProduct->directorate->name;
        })->addColumn('title', function ($photo) {
            return $photo->knowledgeProduct->title;
        })->addColumn('source', function ($photo) {
            return $photo->knowledgeProduct->source;
        })->addColumn('edit', function ($photo) {
            $url = url('photo/' . $photo->id . '/edit');
            return '<a href="' . $url . '"><i class="icon-pen6"></i></a>';
        })->addColumn('delete', function ($photo) {
            return '<a href="" onclick="deletePhoto(' . $photo->id . ')" id=' . $photo->id . ' class="text-danger"><i class="icon-trash"></i></a>';
        })->addColumn('open', function ($photo) {
            return '<a href="' . url('knowledge/' . $photo->knowledgeProduct->id) . '"><i class="icon-new-tab"></i> </a>';
        })->rawColumns(['delete', 'edit', 'open', 'directorate'])->make(true);
    }
}
