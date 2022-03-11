<?php

namespace App\Http\Controllers;

use App\Document;
use App\KnowledgeCategory;
use App\KnowledgeProduct;
use App\Attachment;
use App\UserLog;
use Auth;

use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\DocumentCategory;

class DocumentController extends Controller
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
        $this->authorize('viewKnowledge', KnowledgeProduct::class);
        $documentIds = Document::All()->filter(function ($document) {
            return Auth::user()->can('view', $document->knowledgeProduct);
        })->pluck('id');;

        $documents = Document::whereIn('id', $documentIds)->paginate(20);
        return view('document.document')->with('documents', $documents);
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
        $this->authorize('create', knowledgeProduct::class);
        return view('document.manage_document')->with('new', true);
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
            'contact' => 'string',
            'keywords' => 'required|string',
            'knowledge_description' => 'required|string',
            'document_category_id' => 'required|integer',
            'access_level_id' => 'required|integer'
        ]);

        //Authorize User Action
        $this->authorize('create', knowledgeProduct::class);

        $knowledgeCategory = KnowledgeCategory::firstOrCreate(['category' => 'Document']);

        $request->request->add(['user_id' => Auth::id()]);
        $request->request->add(['views' => 0]);
        $request->request->add(['approved' => false]);
        $request->request->add(['knowledge_category_id' => $knowledgeCategory->id]);

        $knowledgeProduct = KnowledgeProduct::create($request->all());

        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        $document = Document::create($request->all());

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
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Document/' . $document->documentCategory->category . '/', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads' => 0, 'file_url' => $fileNameToStore]);
            }
        }
        UserLog::create([
            'operation' => 'create',
            'action' => 'Created Knowledge Product',
            'remark' => 'Registered this "'.$knowledgeProduct->title.'" Document',
            'affected_table' => 'documents',
            'affected_table' => 'documents',
            'user_id' => Auth::Id(),
        ]);
        return redirect('document')->with('success', 'Document Information Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
        //Authorize User Action
        $this->authorize('view', $document->knowledgeProduct);
        return KnowledgeProduct::find($document->knowledge_product_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //

        //Authorize User Action
        $this->authorize('update', $document->knowledgeProduct);
        return view('document.manage_document')->with('new', false)->with('document', $document);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //

        //Authorize User Action
        $this->authorize('update', $document->knowledgeProduct);

        $this->validate($request, [
            'title' => 'required|string',
            'directorate_id' => 'required|integer',
            'source' => 'required|string',
            'contact' => 'required|string',
            'keywords' => 'required|string',
            'knowledge_description' => 'required|string',
            'document_category_id' => 'required|integer',
            'access_level_id' => 'required|integer'
        ]);

        $knowledgeProduct = KnowledgeProduct::find($document->knowledgeProduct->id);
        $knowledgeProduct->approved = false;
        $knowledgeProduct->update($request->All());

        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        $document->update($request->All());
        $document->save();

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
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Document/' . $document->documentCategory->category . '/', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads' => 0, 'file_url' => $fileNameToStore]);
            }
        }
        
        UserLog::create([
            'operation' => 'update',
            'action' => 'Update Knowledge Product',
            'remark' => 'Updated this "'.$knowledgeProduct->title.'" Document',
            'affected_url' => '',
            'affected_url' => 'search/detail/' . $knowledgeProduct->id,
            'user_id' => Auth::Id(),
        ]);
        return redirect('document')->with('success', 'Document Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //    

        //Authorize User Action
        $this->authorize('delete', $document->knowledgeProduct);

        foreach ($document->knowledgeProduct->attachments as $attachment) {
            if (Storage::exists('Attachment/' . $document->knowledgeProduct->knowledgeCategory->category . '/' . $document->documentCategory->category . '/' . $attachment->file_url))
                Storage::delete('Attachment/' . $document->knowledgeProduct->knowledgeCategory->category . '/' . $document->documentCategory->category . '/' . $attachment->file_url);
        }
        KnowledgeProduct::where('id', $document->knowledge_product_id)->delete();
        
        UserLog::create([
            'operation' => 'delete',
            'action' => 'Delete Knowledge Product',
            'remark' => 'Deleted this "'.$document->knowledgeProduct->name.'" Document',
            'affected_url' => '',
            'affected_table' => 'documents',
            'user_id' => Auth::Id(),
        ]);
        return response()->json(['message' => 'Success']);
    }

    public function filterDocument(DocumentCategory $documentCategory)
    {        
        $documentIds =$documentCategory->document->filter(function ($document) {
            return Auth::user()->can('view', $document->knowledgeProduct);
        })->pluck('id');;

        $documents = Document::whereIn('id', $documentIds)->paginate(20);
        return view('document.document')->with('documents', $documents);
    }
}
