<?php

namespace App\Http\Controllers;

use App\AccessLevel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Auth;

class AccessLevelController extends Controller
{
    public function __construct()
    {
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
     * Show the application configuration.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function access()
    {
        return view('auth.access_control')->with('roles', Role::All());
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
            'level' => 'required|string|unique:access_levels',
            'level_number' => 'required|integer|unique:access_levels',
        ]);
        AccessLevel::create($request->all());
        return redirect('/access')->with('success', 'Access Level Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AccessLevel  $accessLevel
     * @return \Illuminate\Http\Response
     */
    public function show(AccessLevel $accessLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AccessLevel  $accessLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessLevel $accessLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AccessLevel  $accessLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessLevel $accessLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AccessLevel  $accessLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessLevel $accessLevel)
    {
        //

        if ($accessLevel->knowledgeProduct->count() > 0) {
            return response()->json('Can not delete access level');            
        }
        
        $accessLevel->delete();
        return response()->json(['Success']);
    }
}
