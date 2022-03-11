<?php

namespace App\Http\Controllers;

use Auth;
use App\KnowledgeProduct;
use App\ProjectStatus;
use App\Project;

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
    {
        
        $knowledge = Auth::user()->directorate->knowledgeProduct->filter(function ($knowledgeProduct) {
            return Auth::user()->can('view', $knowledgeProduct);
        });

        $projectStatus = ProjectStatus::firstOrCreate([
            'status' => 'complete',
        ]);

        $projects = Project::where('project_status_id', '!=', $projectStatus->id)->get()->filter(function ($project) {
            return Auth::user()->can('view', $project->knowledgeProduct);
        });

        return view('dashboard')->with('knowledge', $knowledge)->with('projects', $projects);
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
