<?php

namespace App\Http\Controllers;

use App\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(['permission:all']);
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
        ProjectCategory::create($request->all());
        return redirect('/configuration')->with('success', 'Project Category Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectCategory $projectCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectCategory  $projectCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectCategory $projectCategory)
    {
        //
        $projectCategory->delete();
        return response()->json(['message'=>'Success']);
    }
}
