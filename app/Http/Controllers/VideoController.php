<?php

namespace App\Http\Controllers;

use App\Video;
use App\knowledgeProduct;
use App\KnowledgeCategory;
use Auth;
use App\UserLog;
use App\Notifications\KnowledgeProductNotification;

use App\Attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VideoController extends Controller
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
        $this->authorize('viewKnowledge', knowledgeProduct::class);

        $videoIds = Video::All()->filter(function ($video) {
            return Auth::user()->can('view', $video->knowledgeProduct);
        })->pluck('id');

        $videos = video::whereIn('id', $videoIds)->paginate(20);

        return view('video.video')->with('videos', $videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', knowledgeProduct::class);
        return view('video.manage_video')->with('new', true);
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
        $this->authorize('create', knowledgeProduct::class);

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

        $knowledgeCategory = KnowledgeCategory::firstOrCreate(['category' => 'Video']);

        $request->request->add(['user_id' => Auth::id()]);
        $request->request->add(['views' => 0]);
        $request->request->add(['approved' => false]);
        $request->request->add(['knowledge_category_id' => $knowledgeCategory->id]);

        $knowledgeProduct = KnowledgeProduct::create($request->all());

        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        Video::create($request->all());

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
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Video/', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads' => 0, 'file_url' => $fileNameToStore]);
            }
        }
        
        UserLog::create([
            'operation' => 'create',
            'action' => 'Register Knowledge Product',
            'remark' => 'Added This "' . $knowledgeProduct->title . '" Video',
            'affected_url' => 'search/detail/' . $knowledgeProduct->id,
            'affected_table' => 'videos',
            'user_id' => Auth::Id(),
        ]);
        
        // foreach(Auth::user()->directorate->user as $user)
        //     $user->notify(new KnowledgeProductNotification($knowledgeProduct));
            
        return redirect('video')->with('success', 'Video Information Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //Authorize User Action
        $this->authorize('view', $video->knowledgeProduct);
        return view('video.manage_video')->with('new', false)->with('video', $video);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //Authorize User
        $this->authorize('update', $video->knowledgeProduct);
        return view('video.manage_video')->with('new', false)->with('video', $video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //

        //Authorize User
        $this->authorize('update', $video->knowledgeProduct);

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


        $knowledgeProduct = KnowledgeProduct::find($video->knowledgeProduct->id);
        $knowledgeProduct->update($request->All());

        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        $video->update($request->All());
        $video->save();

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
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Video/', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads' => 0, 'file_url' => $fileNameToStore]);
            }
        }
        
        UserLog::create([
            'operation' => 'update',
            'action' => 'Update Knowledge Product',
            'remark' => 'Updated This "' . $knowledgeProduct->title . '" Video',
            'affected_url' => 'search/detail/' . $knowledgeProduct->id,
            'affected_table' => 'videos',
            'user_id' => Auth::Id(),
        ]);

        return redirect('video')->with('success', 'Video Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
        //Authorize User
        $this->authorize('delete', $video->knowledgeProduct);

        foreach ($video->knowledgeProduct->attachments as $attachment) {
            if (Storage::exists('Attachment/' . $video->knowledgeProduct->knowledgeCategory->category . '/' . $attachment->file_url))
                Storage::delete('Attachment/' . $video->knowledgeProduct->knowledgeCategory->category . '/' . $attachment->file_url);
        }

        $knowledgeProduct = KnowledgeProduct::find($video->knowledge_product_id);

        UserLog::create([
            'operation' => 'delete',
            'action' => 'Deleted Knowledge Product',
            'remark' => 'Deleted This "' . $knowledgeProduct->title . '" Video',
            'affected_url' => '/search/detail/' . $knowledgeProduct->id,
            'affected_table' => 'videos',
            'user_id' => Auth::Id(),
        ]);
        $knowledgeProduct->delete();

        return response()->json(['message' => 'Success']);
    }
}
