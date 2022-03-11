<?php

namespace App\Http\Controllers;

use App\KnowledgeComment;
use Auth;
use Illuminate\Http\Request;

class KnowledgeCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->middleware('auth');
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
         $this->validate($request, [
            'message' => 'required|string',
        ]);
        $request->request->add(['user_id'=>Auth::id()]);
        knowledgeComment::create($request->all());
        return redirect()->back()->with('success', 'Comment Submitted Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KnowledgeComment  $knowledgeComment
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeComment $knowledgeComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KnowledgeComment  $knowledgeComment
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeComment $knowledgeComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KnowledgeComment  $knowledgeComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KnowledgeComment $knowledgeComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KnowledgeComment  $knowledgeComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeComment $knowledgeComment)
    {
        //
        $knowledgeComment->delete();
        return response()->json('Success');
    }
}
