<?php

namespace App\Http\Controllers;

use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {   $knowledge = [];
        if(Auth::user()->hasAnyPermission('All')){
            $knowledge = \App\KnowledgeProduct::all();

        }else if(Auth::user()->hasAnyPermission('manage directorate')){
            $knowledge = auth()->user()->knowledgeProduct;
        }
        return view('dashboard')->with('knowledge', $knowledge);
    }
    
    /**
     * Show the application configuration.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function configuration()
    {
        if(Auth::user()->hasPermissionTo('all')){
            return view('config');
        }else {
            return redirect()->back()->with('error', 'unauthorized Action');
        }
    }
    
    
}
