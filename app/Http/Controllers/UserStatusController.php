<?php

namespace App\Http\Controllers;

use App\UserStatus;
use Illuminate\Http\Request;

class UserStatusController extends Controller
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
        UserStatus::create($request->all());
        return redirect('/configuration')->with('success', 'User Status Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserStatus  $userStatus
     * @return \Illuminate\Http\Response
     */
    public function show(UserStatus $userStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserStatus  $userStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(UserStatus $userStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserStatus  $userStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserStatus $userStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserStatus  $userStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserStatus $userStatus)
    {
        //
        $userStatus->delete();
        return response()->json(['message'=>'Success']);
    }
}
