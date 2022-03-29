<?php

namespace App\Http\Controllers;

use App\Map;
use App\KnowledgeProduct;
use App\KnowledgeCategory;
use App\Attachment;
use Auth;

use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function __construct(){
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
        $maps = Map::All()->filter(function ($map) {
            return Auth::user()->can('view', $map->knowledgeProduct);
        });

        return view('map.map')->with('maps', $maps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('map.manage_map')->with('new', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required|string',
            'directorate_id' => 'required|integer',
            'source' => 'required|string',
            'contact' => 'required|string',
            'keywords' => 'required|string',
            'knowledge_description' => 'required|string',
            'access_level_id' => 'required|integer',
            'created_date' => 'required|date',
            'map_type_id' => 'required|integer'
        ]);

        $knowledgeCategory = KnowledgeCategory::firstOrCreate(['category'=>'Map']);

        $request->request->add(['user_id'=>Auth::id()]);
        $request->request->add(['views'=>0]);
        $request->request->add(['approved' => false]);
        $request->request->add(['knowledge_category_id' => $knowledgeCategory->id]);

        $knowledgeProduct = KnowledgeProduct::create($request->all());

        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        Map::create($request->all());
        
        if($request->hasFile('attachment')){
            $count = count($request->file('attachment'));
            for($i = 0; $i < $count; $i++){   
                //get file name with extension
                $fileNameWithExt = $request->file('attachment')[$i]->getClientOriginalName();
                //Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //File extension
                $extension = $request->file('attachment')[$i]->getClientOriginalExtension();
                //File name to store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Map', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads'=>0, 'file_url'=>$fileNameToStore]);
            }
        }

        return redirect('map')->with('success', 'Map Information Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function show(Map $map)
    {
        //
        $mapProduct = KnowledgeProduct::find($mapProduct);        
        return view('map.map_detail')->with('map', $mapProduct);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function edit(Map $map)
    {
        //
        return view('map.manage_map')->with('new', false)->with('map', $map);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Map $map)
    {
        //
        $this->validate($request, [
            'title' => 'required|string',
            'directorate_id' => 'required|integer',
            'source' => 'required|string',
            'contact' => 'required|string',
            'keywords' => 'required|string',
            'knowledge_description' => 'required|string',
            'access_level_id' => 'required|integer',
            'created_date' => 'required|date'
        ]);


        $knowledgeProduct = KnowledgeProduct::find($map->knowledgeProduct->id);
        $knowledgeProduct->approved = false;
        $knowledgeProduct->update($request->All());

        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        $map->update($request->All());
        $map->save();
        
        if($request->hasFile('attachment')){
            $count = count($request->file('attachment'));
            for($i = 0; $i < $count; $i++){   
                //get file name with extension
                $fileNameWithExt = $request->file('attachment')[$i]->getClientOriginalName();
                //Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //File extension
                $extension = $request->file('attachment')[$i]->getClientOriginalExtension();
                //File name to store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Map', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads'=>0, 'file_url'=>$fileNameToStore]);
            }
        }
        return redirect('map')->with('success', 'Map Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy(Map $map)
    {
        //
        foreach($map->knowledgeProduct->attachments as $attachment){
            if(Storage::exists('Attachment/'.$map->knowledgeProduct->knowledgeCategory->category.'/'.$attachment->file_url))
                Storage::delete('Attachment/'.$map->knowledgeProduct->knowledgeCategory->category.'/'.$attachment->file_url);            
        }
        
        KnowledgeProduct::find($map->knowledge_product_id)->delete();

        return response()->json(['message'=>'Success']);
    }
    
    public function tableData()
    {
        return Datatables::of(Map::with('knowledgeProduct'))->addColumn('directorate', function ($map) {
            return $map->knowledgeProduct->directorate->name;
        })->addColumn('title', function ($map) {
            return $map->knowledgeProduct->title;
        })->addColumn('source', function ($map) {
            return $map->knowledgeProduct->source;
        })->addColumn('map_type', function ($map) {
            return $map->mapType->type;
        })->addColumn('edit', function ($map) {
            $url = url('/map/'.$map->id.'/edit');
            return '<a href="'.$url.'"><i class="icon-pen6"></i></a>';
        })->addColumn('delete', function ($map) {
            return '<a href="" onclick="deleteMap('.$map->id.')" id='.$map->id.' class="text-danger"><i class="icon-trash"></i></a>';
        })->addColumn('open', function ($map) {
            return '<a href="'.url('knowledge/'.$map->knowledgeProduct->id).'"><i class="icon-new-tab"></i> </a>';
        })->rawColumns(['delete','edit', 'open'])->make(true);
    }
}
