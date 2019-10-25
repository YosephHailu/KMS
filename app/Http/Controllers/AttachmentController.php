<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\KnowledgeCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Auth;
class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        //
        if(Auth::check()){
        $this->authorize('view', $attachment->knowledgeProduct);
        }else{
            if($attachment->knowledgeProduct->accessLevel->level_number > 0){
                abort(403);
            }
        }
        
        $knowledgeCategory = $attachment->knowledgeProduct->knowledgeCategory;
        $document = KnowledgeCategory::firstOrCreate(['category'=>'Document']);
        $sub_url =$knowledgeCategory->id==$document->id ? $attachment->knowledgeProduct->document->documentCategory->category: "";

        $attachment->downloads = $attachment->downloads + 1;
        $attachment->save();
        if(Storage::exists('Attachment/'.$knowledgeCategory->category.'/'. $sub_url.'/'.$attachment->file_url))        
            return Storage::download('Attachment/'.$knowledgeCategory->category.'/'. $sub_url.'/'.$attachment->file_url);  
        else
            return redirect()->back()->with('error', "Can not Find Attachment Try Again Latter");
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function getAttachment(Attachment $attachment)
    {
        $knowledgeCategory = $attachment->knowledgeProduct->knowledgeCategory;
        $document = KnowledgeCategory::firstOrCreate(['category'=>'Document']);
        $sub_url =$knowledgeCategory->id==$document->id ? $attachment->knowledgeProduct->document->documentCategory->category: "";

        $path = storage_path('app/Attachment/'.$knowledgeCategory->category.'/'. $sub_url.'/'.$attachment->file_url);

        if (!File::exists($path)) {
            abort(404);
        }
    
        $file = File::get($path);
        $type = File::mimeType($path);
    
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
    
        return $response;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        //
        $knowledgeCategory = $attachment->knowledgeProduct->knowledgeCategory;
        $document = KnowledgeCategory::firstOrCreate(['category'=>'Document']);
        $sub_url =$knowledgeCategory->id==$document->id ? $attachment->knowledgeProduct->document->documentType: "";

        if(Storage::exists('Attachment/'.$knowledgeCategory->category.'/'. $sub_url.'/'.$attachment->file_url))
            Storage::delete('Attachment/'.$knowledgeCategory->category.'/'. $sub_url.'/'.$attachment->file_url);
        $attachment->delete();

        return response()->json(['message'=>'Success']);
    }
}
