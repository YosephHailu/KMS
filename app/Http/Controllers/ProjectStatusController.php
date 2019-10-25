<?php

namespace App\Http\Controllers;

use App\ProjectStatus;
use Illuminate\Http\Request;

class ProjectStatusController extends Controller
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
            'status' => 'required|string',
        ]);
        ProjectStatus::create($request->all());
        return redirect('/configuration')->with('success', 'Project Status Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectStatus  $projectStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectStatus $projectStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectStatus  $projectStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectStatus $projectStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectStatus  $projectStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectStatus $projectStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectStatus  $projectStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectStatus $projectStatus)
    {
        //
        $projectStatus->delete();
        return response()->json(['message'=>'Success']);
    }
}
