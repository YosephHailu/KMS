<?php

namespace App\Http\Controllers;

use App\MapType;
use Illuminate\Http\Request;

class MapTypeController extends Controller
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
            'type' => 'required|string',
        ]);
        MapType::create($request->all());
        return redirect('/configuration')->with('success', 'Map Type Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MapType  $mapType
     * @return \Illuminate\Http\Response
     */
    public function show(MapType $mapType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MapType  $mapType
     * @return \Illuminate\Http\Response
     */
    public function edit(MapType $mapType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MapType  $mapType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MapType $mapType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MapType  $mapType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MapType $mapType)
    {
        //
        $mapType->delete();
        return response()->json(['message'=>'Success']);
    }
}
