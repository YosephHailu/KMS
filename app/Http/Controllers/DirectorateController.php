<?php

namespace App\Http\Controllers;

use App\Directorate;
use Illuminate\Http\Request;
use Auth;

class DirectorateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:all'])->except(['newsView', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $directorates = Directorate::paginate(10);
        return view('directorate.directorates')->with('directorates', $directorates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        
        $this->authorize('create', Directorate::class);
        return view('directorate.manage_directorate')->with('new', true);
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
        $this->authorize('create', Directorate::class);

        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'contact' => 'required|string',
            'manager' => 'required|string',
        ]);

        Directorate::create($request->all());
        return redirect('directorate')->with('success', 'Directorate Information Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Directorate  $directorate
     * @return \Illuminate\Http\Response
     */
    public function show(Directorate $directorate)
    {
        //
        $this->authorize('view', Directorate::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Directorate  $directorate
     * @return \Illuminate\Http\Response
     */
    public function edit(Directorate $directorate)
    {
        //
        $this->authorize('update', $directorate);

        return view('directorate.manage_directorate')->with('new', false)->with('directorate', $directorate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Directorate  $directorate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Directorate $directorate)
    {
        //
        $this->authorize('update', $directorate);

        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'contact' => 'required|string',
            'manager' => 'required|string',
        ]);

        $directorate->update($request->all());
        return redirect('directorate')->with('success', 'Directorate Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Directorate  $directorate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Directorate $directorate)
    {
        $this->authorize('view', $directorate);

        //Check if there is any knowledge posted 
        if($directorate->knowledgeProduct->count() > 0)
            return response()->json('Error can not delete --// Please remove users and knowledge products first');

        $directorate->delete();
        return response()->json('Successfully Deleted');
    }
}
