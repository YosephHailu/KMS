<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Auth;

class LinkController extends Controller
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
        $link = Link::All();
        return view('link.links')->with('links', $link);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('link.manage_link')->with('new', true);  
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
            'name' => 'required|string|max:255',
            'link' => 'required|string',
        ]);
        
        link::create($request->all());
        return redirect('link')->with('success', 'link Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        //
        return view('link.manage_link')->with('new', false)->with('link', $link);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        //
        
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'link' => 'required|string',
        ]);
        
        $link->update($request->all());
        return redirect('link')->with('success', 'link Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        //
        $link->delete();
        return response()->json('Success');
    }
}
