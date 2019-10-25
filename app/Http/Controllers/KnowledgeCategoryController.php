<?php

namespace App\Http\Controllers;

use App\knowledgeCategory;
use Illuminate\Http\Request;

class KnowledgeCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:all'])->except(['contacts']);
    }

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
        $this->validate($request, [
            'category' => 'required|string',
        ]);
        KnowledgeCategory::create($request->all());
        return redirect('/configuration')->with('success', 'Knowledge Category Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\knowledgeCategory  $knowledgeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(knowledgeCategory $knowledgeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\knowledgeCategory  $knowledgeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(knowledgeCategory $knowledgeCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\knowledgeCategory  $knowledgeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, knowledgeCategory $knowledgeCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\knowledgeCategory  $knowledgeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(knowledgeCategory $knowledgeCategory)
    {
        //
        $knowledgeCategory->delete();
        return response()->json('Success');
    }
}
