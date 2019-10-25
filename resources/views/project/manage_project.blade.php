@extends('layouts.app')

@section('css')

@endsection
@section('content')

@section('breadcrumb')

<a href="{{url('projects')}}" class="breadcrumb-item"> Project</a>
<span class="breadcrumb-item active">{{$new?'Add Project': 'Edit Project'}}</span>
@endsection

<div class="card content">

    @if (!$new)
    {!! Form::open(['action' => ['ProjectController@update',$project->id], 'method'=> 'POST',
    'enctype'=>'multipart/form-data']) !!}
    @else
    {!! Form::open(['action' => ['ProjectController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
    @endif
    <div class="card-header text-center bg-blue pb-0">
        <i class="icon-pencil6"></i>
        <legend class="text-uppercase font-size-sm  text-center font-weight-bold">Project Registration Form</legend>
    </div>
    <div class="card-body p-0">
        <div class="col-md-12 pt-2">
            <div class="row" id="formDiv">
                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Project Title * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('project_title', $new?'':$project->project_title,['class'=>'form-control', 'placeholder'=>''])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Directorate</label>
                    <div class="form-group">
                        {{Form::select('directorate_id', App\Directorate::pluck('name','id'), $new?null:$project->directorate_id, 
                                    ['class'=>'form-control select-search'])}}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Project Category</label>
                    <div class="form-group">
                        {{Form::select('project_category_id', App\ProjectCategory::pluck('category','id'), $new?null:$project->project_category_id, 
                                    ['class'=>'form-control select-search'])}}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Project Manager * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('manager', $new?'':$project->manager,['class'=>'form-control','placeholder'=>''])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <label class="form-text text-muted">Starting Date * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::date('starting_date', $new?\Carbon\Carbon::now():$project->starting_date,['class'=>'form-control'])}}
                        <div class="form-control-feedback">
                            <i class="icon-calendar22"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <label class="form-text text-muted">Ending Date * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::date('end_date', $new?\Carbon\Carbon::now():$project->end_date,['class'=>'form-control'])}}
                        <div class="form-control-feedback">
                            <i class="icon-calendar22"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Contract Number * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('contract_no', $new?'':$project->contract_no,['class'=>'form-control','placeholder'=>''])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Beneficiaries Region * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('beneficiaries_region', $new?'':$project->beneficiaries_region,
                                    ['class'=>'tokenfield form-control','data-fouc','placeholder'=>'Add Region Names'])}}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Wereda/Kebele * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('wereda_kebele', $new?'':$project->wereda_kebele,
                                    ['class'=>'tokenfield form-control','data-fouc','placeholder'=>'Add Wereda'])}}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Project Status</label>
                    <div class="form-group">
                        {{Form::select('project_status_id', App\ProjectStatus::pluck('status','id'), $new?null:$project->status, 
                                    ['class'=>'form-control select-search'])}}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Document Access Level</label>
                    <div class="form-group">
                        {{Form::select('access_level_id', App\AccessLevel::pluck('level','id'), $new?null:$project->access_level_id, 
                                    ['class'=>'form-control select-search'])}}
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <label class="form-text text-muted">Key Words * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('keywords', $new?'':$project->knowledgeProduct->keywords,
                                        ['class'=>'tokenfield form-control','data-fouc','placeholder'=>'Add Keywords'])}}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Knowledge Description * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::textarea('knowledge_description', $new?'':$project->knowledge_description,['class'=>'form-control','placeholder'=>''])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Project Description * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::textarea('project_description', $new?'':$project->project_description,['class'=>'form-control','placeholder'=>''])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Outcome * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::textarea('outcome', $new?'':$project->outcome,['class'=>'form-control','placeholder'=>''])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                @if($new || $project->projectFinance->count() < 1) <fieldset style="border:1px solid black"
                    class="col-md-6 col-lg-4">
                    <div class="col-12">
                        <label class="form-text text-muted">Finance Source
                            <i class="float-right icon-add text-blue" onclick="addFinance()"></i></label>
                        <div class="form-group">
                            {{Form::select('finance_id[]', App\Finance::pluck('donner_name','id'), null, 
                                    ['class'=>'form-control select-search'])}}
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-text text-muted">Unit</label>
                        <div class="form-group">
                            {{Form::select('unit_id[]', App\Unit::pluck('name','id'), null, 
                                        ['class'=>'form-control select-search'])}}
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-text text-muted">Budget * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('budget[]', $new?'':$project->budget,['class'=>'form-control','placeholder'=>''])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div>
                    </div>
                    </fieldset>
                    @else

                    @foreach ($project->projectFinance as $projectFinance)
                    <fieldset style="border:1px solid black"
                        class="col-md-6 col-lg-4 finance_form finance_form_{{$loop->index}}">
                        <div class="col-12">
                            <label class="form-text text-muted">Finance Source
                                <i class="float-right btns icon-add text-blue ml-3" onclick="addFinance()"></i>
                                <i class="float-right btns icon-trash text-danger"
                                    onclick="removeFinance({{$loop->index}})"></i></label>
                            <div class="form-group">
                                {{Form::select('finance_id[]', App\Finance::pluck('donner_name','id'), $projectFinance->finance_id, 
                                    ['class'=>'form-control select-search'])}}
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-text text-muted">Unit</label>
                            <div class="form-group">
                                {{Form::select('unit_id[]', App\Unit::pluck('name','id'), $projectFinance->unit_id, 
                                        ['class'=>'form-control select-search'])}}
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-text text-muted">Budget * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('budget[]', $projectFinance->budget,['class'=>'form-control','placeholder'=>''])}}
                                <div class="form-control-feedback">
                                    <i class="icon-text-width"></i>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    @endforeach
                    @endif

                    <legend class="mt-0 p-0" id="financeDiv"></legend>

                    <div class="col-lg-4 col-md-6" id="file">
                        <div class="form-group form-group-feedback form-group-feedback-right">
                            {{Form::file('attachment[]',['class'=>'form-control '])}}
                            <a href="#" onclick="addForm()" class="btn-add-file">
                                <div class="form-control-feedback pt-1">
                                    <i class="icon-add"></i>
                                </div>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="{{url()->previous()}}" class="btn btn-info ">Cancel-/-Back</a>
        @if (!$new)
        {{Form::hidden('_method','PUT')}}
        @endif
        {{Form::submit($new?'Save':'Edit',['class'=>'btn btn-primary float-right'])}}
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('script')
<script src="{{ asset('global_assets/js/demo_pages/form_select2.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/inputs/inputmask.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>
<script src="{{ asset('global_assets/js/demo_pages/picker_date.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>

<script src="{{ asset('js/script.js')}}"></script>

<script>
    function addForm(){
        event.preventDefault();
        $('#formDiv').append($('#file').clone());
    }

    @if($new)
        var finance_counter = 0;
    @else
        var finance_counter = {{$project->projectFinance->count()}};
    @endif

        function addFinance(){
            $('#financeDiv').prepend(`
                <fieldset style="border:1px solid black" class="col-md-6 col-lg-4 finance_form finance_form_${finance_counter}">
                    <div class="col-12">
                        <label class="form-text text-muted">Finance Source
                                <i class="float-right btns icon-add text-blue pl-3" onclick="addFinance()"></i>
                                <i class="float-right btns icon-trash text-danger" onclick="removeFinance(${finance_counter})"></i></label>
                        <div class="form-group">
                            {{Form::select('finance_id[]', App\Finance::pluck('donner_name','id'), $new?null:$project->finance_id, 
                                    ['class'=>'form-control select-search'])}}
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-text text-muted">Unit</label>
                        <div class="form-group">
                            {{Form::select('unit_id[]', App\Unit::pluck('name','id'), $new?null:$project->unit_id, 
                                        ['class'=>'form-control select-search'])}}
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-text text-muted">Budget * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('budget[]', $new?'':$project->budget,['class'=>'form-control','placeholder'=>''])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div>
                    </div>
                </fieldset>
            `);
            finance_counter++;

            $('.select-search').select2();
        }

        function removeFinance(counter){
            if($('.finance_form').length<=1)
                return false;
            $(".finance_form_"+counter).remove();
        }
</script>
@endsection