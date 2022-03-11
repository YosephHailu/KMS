<?php

namespace App\Http\Controllers;

use App\Project;
use App\KnowledgeProduct;
use App\KnowledgeCategory;
use App\UserLog;
use App\Attachment;
use App\ProjectFinance;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use \Carbon\Carbon;
use Auth;

class ProjectController extends Controller
{

    public function __construct()
    {

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
        //Authorize User Action
        $this->authorize('viewKnowledge', KnowledgeProduct::class);
        return view('project.projects');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //Authorize User Action
        $this->authorize('create', KnowledgeProduct::class);
        return view('project.manage_project')->with('new', true);
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
            'project_category_id' => 'required|integer',
            'directorate_id' => 'required|integer',
            'project_title' => 'required|string',
            'project_description' => 'required|string',
            'outcome' => 'required|string',
            'starting_date' => 'required|date',
            'end_date' => 'required|date',
            'source' => 'required|string',
            'finance_id.*' => 'required',
            'beneficiaries_region' => 'required|string',
            'manager' => 'required|string',
            'budget.*' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'knowledge_description' => 'required|string',
            'access_level_id' => 'required|integer',
            'project_status_id' => 'required|integer',
            'unit_id.*' => 'required|integer',
            'contract_no' => 'required|string'
        ]);

        //Authorize User Action
        $this->authorize('create', KnowledgeProduct::class);


        $knowledgeCategory = KnowledgeCategory::firstOrCreate(['category' => 'Project']);

        $knowledgeProduct = KnowledgeProduct::create([
            'title' => $request->project_title,
            'directorate_id' => $request->directorate_id,
            'source' => $request->source,
            'approved' => false,
            'contact' => $request->manager,
            'keywords' => $request->product_title . ',' . $request->wereda_kebele.','.$request->keywords,
            'knowledge_description' => $request->knowledge_description,
            'knowledge_category_id' => $knowledgeCategory->id,
            'access_level_id' => $request->access_level_id,
            'views' => 0,
            'user_id' => Auth::id()
        ]);


        // return Carbon::parse($date[0])->format('d, m, Y');
        $request->request->add(['knowledge_product_id' => $knowledgeProduct->id]);
        $request->request->add(['user_id' => Auth::id()]);

        $project = Project::create($request->all());

        
        $count_finance = count($request->input('finance_id'));
        for ($i_counter = 0; $i_counter < $count_finance; $i_counter++) {
            ProjectFinance::create([
                'budget' => $request->budget[$i_counter],
                'finance_id' => $request->finance_id[$i_counter],
                'unit_id' => $request->unit_id[$i_counter],
                'project_id' => $project->id,
            ]);
        }

        if ($request->hasFile('attachment')) {
            $count = count($request->file('attachment'));
            for ($i = 0; $i < $count; $i++) {
                //get file name with extension
                $fileNameWithExt = $request->file('attachment')[$i]->getClientOriginalName();
                //Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //File extension
                $extension = $request->file('attachment')[$i]->getClientOriginalExtension();
                //File name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload Image
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Project/', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads' => 0, 'file_url' => $fileNameToStore]);
            }
        } else {
            $fileNameToStore = 'noFile.jpg';
        }

        UserLog::create([
            'operation' => 'create',
            'action' => 'Create Knowledge Product',
            'remark' => 'Register This "' . $knowledgeProduct->title . '" Project Information',
            'affected_url' => 'search/detail/' . $knowledgeProduct->id,
            'affected_table' => 'projects',
            'user_id' => Auth::Id(),
        ]);

        return redirect('projects')->with('success', 'Project Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        //Authorize User Action
        $this->authorize('update', $project->knowledgeProduct);
        return view('project.manage_project')->with('new', false)->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //

        $this->validate($request, [
            'project_category_id' => 'required|integer',
            'directorate_id' => 'required|integer',
            'project_title' => 'required|string',
            'project_description' => 'required|string',
            'outcome' => 'required|string',
            'starting_date' => 'required|date',
            'end_date' => 'required|date',
            'source' => 'required|string',
            'finance_id.*' => 'required',
            'beneficiaries_region' => 'required|string',
            'manager' => 'required|string',
            'budget.*' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'knowledge_description' => 'required|string',
            'unit_id.*' => 'required|integer',
            'access_level_id' => 'required|integer',
            'project_status_id' => 'required|integer',
            'contract_no' => 'required|string'
        ]);

        //Authorize User Action
        $this->authorize('update', $project->knowledgeProduct);

        $knowledgeProduct = $project->knowledgeProduct;
        $knowledgeProduct->update([
            'title' => $request->project_title,
            'directorate_id' => $request->directorate_id,
            'source' => $request->source,
            'contact' => $request->manager,
            'approved' => false,
            'keywords' => $request->product_title . ',' . $request->wereda_kebele.','.$request->keywords,
            'knowledge_description' => $request->knowledge_description,
            'access_level_id' => $request->access_level_id,
        ]);

        ProjectFinance::whereIn('id', $project->projectFinance->pluck('id'))->delete();

        $project->update($request->all());

        //Update project finance
        $count_finance = count($request->input('finance_id'));
        for ($i_counter = 0; $i_counter < $count_finance; $i_counter++) {
            ProjectFinance::create([
                'budget' => $request->budget[$i_counter],
                'finance_id' => $request->finance_id[$i_counter],
                'unit_id' => $request->unit_id[$i_counter],
                'project_id' => $project->id,
            ]);
        }

        if ($request->hasFile('attachment')) {
            $count = count($request->file('attachment'));
            for ($i = 0; $i < $count; $i++) {
                //get file name with extension
                $fileNameWithExt = $request->file('attachment')[$i]->getClientOriginalName();
                //Get only file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //File extension
                $extension = $request->file('attachment')[$i]->getClientOriginalExtension();
                //File name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                //Upload Image
                $path = $request->file('attachment')[$i]->storeAs('Attachment/Project/', $fileNameToStore);

                Attachment::create(['title' => $fileName, 'knowledge_product_id' => $knowledgeProduct->id, 'downloads' => 0, 'file_url' => $fileNameToStore]);
            }
        } else {
            $fileNameToStore = 'noFile.jpg';
        }

        UserLog::create([
            'operation' => 'create',
            'action' => 'Create Knowledge Product',
            'remark' => 'Updated This "' . $knowledgeProduct->title . '" Project Information',
            'affected_url' => 'search/detail/' . $knowledgeProduct->id,
            'affected_table' => 'projects',
            'user_id' => Auth::Id(),
        ]);

        return redirect('projects')->with('success', 'Project Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //

        //Authorize User Action
        $this->authorize('delete', $project->knowledgeProduct);

        foreach ($project->knowledgeProduct->attachments as $attachment) {
            if (Storage::exists('Attachment/Project/' . $attachment->file_url))
                Storage::delete('Attachment/Project/' . $attachment->file_url);
        }

        UserLog::create([
            'operation' => 'delete',
            'action' => 'Deleted Knowledge Product',
            'remark' => 'Deleted This "' . $project->knowledgeProduct->title . '" Project',
            'affected_url' => 'search/detail/' . $project->knowledgeProduct->id,
            'affected_table' => 'projects',
            'user_id' => Auth::Id(),
        ]);
        
        KnowledgeProduct::find($project->knowledge_product_id)->delete();
        $project->delete();

        return response()->json(['message' => 'Success']);
    }

    public function tableData()
    {
        $projects = Project::All()->filter(function ($project) {
            return Auth::user()->can('view', $project->knowledgeProduct);
        });

        return Datatables::of($projects->sortByDesc('id'))->addColumn('directorate', function ($project) {
            return $project->directorate->name;
        })->addColumn('edit', function ($project) {
            $url = url('projects/' . $project->id . '/edit');
            if (Auth::user()->can('update', $project->knowledgeProduct))
                return '<a href="' . $url . '"><i class="icon-pen6"></i></a>';
            else
                return '';
        })->addColumn('delete', function ($project) {
            if (Auth::user()->can('delete', $project->knowledgeProduct))
                return '<a href="" onclick="deleteProject(' . $project->id . ')" id=' . $project->id . ' class="text-danger"><i class="icon-trash"></i></a>';
            else
                return '';
        })->addColumn('open', function ($project) {
            return '<a href="' . url('knowledge/' . $project->knowledgeProduct->id) . '"><i class="icon-new-tab"></i> </a>';
        })->addColumn('category', function ($project) {
            return $project->projectCategory->category;
        })->addColumn('project_status', function ($project) {
            return $project->projectStatus->status;
        })->rawColumns(['delete', 'edit', 'open'])->make(true);
    }
}
