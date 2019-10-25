<?php

namespace App\Http\Controllers;

use App\KnowledgeRating;
use Auth;
use Illuminate\Http\Request;

class KnowledgeRatingController extends Controller
{
    
    public function __construct(){
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
            'rating' => 'required|integer|max:5|min:1',
        ]);
        
        $request->request->add(['user_id'=>Auth::id()]);
        KnowledgeRating::create($request->all());
        return redirect()->back()->with('success', 'Ratting Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KnowledgeRating  $knowledgeRating
     * @return \Illuminate\Http\Response
     */
    public function show(KnowledgeRating $knowledgeRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KnowledgeRating  $knowledgeRating
     * @return \Illuminate\Http\Response
     */
    public function edit(KnowledgeRating $knowledgeRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KnowledgeRating  $knowledgeRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KnowledgeRating $knowledgeRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KnowledgeRating  $knowledgeRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(KnowledgeRating $knowledgeRating)
    {
        //
    }
}
