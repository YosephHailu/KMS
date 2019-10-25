<?php

namespace App\Http\Controllers;

use App\Finance;
use Illuminate\Http\Request;
use Auth;

class FinanceController extends Controller
{
    public function __construct()
    {
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

        $finances = Finance::All();
        return view('finance.finances')->with('finances', $finances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('finance.manage_finance')->with('new', true);
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
            'donner_name' => 'required|string',
            'credit' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required|string',
        ]);

        Finance::create($request->all());
        return redirect('finance')->with('success', 'Finance Information Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function edit(Finance $finance)
    {
        //
        return view('finance.manage_finance')->with('new', false)->with('finance', $finance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Finance $finance)
    {
        //
        $this->validate($request, [
            'donner_name' => 'required|string',
            'credit' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required|string',
        ]);

        $finance->update($request->all());
        return redirect('finance')->with('success', 'Finance Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Finance $finance)
    {        
        //Check if there is any knowledge financed by \App\finance

        if($finance->projectFinance->count() > 0)
            return response()->json('Error can not delete');

        $finance->delete();
        return response()->json('Success');
    }
}
