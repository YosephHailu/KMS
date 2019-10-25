@extends('layouts.app')

@section('header')


@endsection

@section('content')

@section('breadcrumb')

<a href="{{url('video')}}" class="breadcrumb-item"> Video</a>
<span class="breadcrumb-item active">{{$new?'Add Video': 'Edit Video'}}</span>
@endsection

<div class="card content">
    <div class="card-header text-center bg-blue pb-0">
        <i class="icon-pencil6"></i>
        <legend class="text-uppercase font-size-sm font-weight-bold">Knowledge Product Registration Form</legend>
    </div>
    @if (!$new)
    {!! Form::open(['action' => ['VideoController@update',$video->id], 'method'=> 'POST',
    'enctype'=>'multipart/form-data']) !!}
    @else
    {!! Form::open(['action' => ['VideoController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
    @endif

    <div class="card-body p-0">
        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
            <li class="nav-item"><a href="{{url('document/create')}}" class="nav-link">Documents</a></li>
            <li class="nav-item"><a href="{{url('video/create')}}" class="nav-link active">Videos</a></li>
            <li class="nav-item"><a href="{{url('photo/create')}}" class="nav-link">Photos</a></li>
            <li class="nav-item"><a href="{{url('map/create')}}" class="nav-link">Maps</a></li>
        </ul>

        <div class="tab-content p-1">
            <div class="tab-pane fade show active" id="bottom-justified-tab1">
                <fieldset>
                    <div class="col-md-12 pt-2">
                        <div class=" row" id="formDiv">
                            <div class="col-md-6 col-lg-4">
                                <label class="form-text text-muted"> Title * </label>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    {{Form::text('title', $new?'':$video->knowledgeProduct->title,['class'=>'form-control', 'placeholder'=>''])}}
                                    <div class="form-control-feedback">
                                        <i class="icon-text-width"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-text text-muted">Directorate</label>
                                <div class="form-group">
                                    {{Form::select('directorate_id', App\Directorate::pluck('name','id'), $new?null:$video->knowledgeProduct->directorate_id, 
                                            ['class'=>'form-control select-search'])}}
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-text text-muted">Source / Author * </label>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    {{Form::text('source', $new?'':$video->knowledgeProduct->source,['class'=>'form-control','placeholder'=>''])}}
                                    <div class="form-control-feedback">
                                        <i class="icon-text-width"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-text text-muted">Contact * </label>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    {{Form::text('contact', $new?'':$video->knowledgeProduct->contact,['class'=>'form-control','placeholder'=>''])}}
                                    <div class="form-control-feedback">
                                        <i class="icon-text-width"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-text text-muted">Created Date * </label>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    {{Form::date('created_date', $new?\Carbon\Carbon::now():$video->created_date,['class'=>'form-control','id'=>'nytime-month-numeric'])}}
                                    <div class="form-control-feedback">
                                        <i class="icon-calendar22"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-text text-muted">Goal </label>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    {{Form::text('goal', $new?'':$video->goal,['class'=>'form-control','placeholder'=>''])}}
                                    <div class="form-control-feedback">
                                        <i class="icon-text-width"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-text text-muted">Key Words * </label>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    {{Form::text('keywords', $new?'':$video->knowledgeProduct->keywords,
                                            ['class'=>'tokenfield form-control','data-fouc','placeholder'=>'Add Keywords'])}}
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label class="form-text text-muted">Access Level</label>
                                <div class="form-group">
                                    {{Form::select('access_level_id', App\AccessLevel::pluck('level','id'), $new?null:$video->knowledgeProduct->access_level_id, 
                                            ['class'=>'form-control select-search'])}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-text text-muted">Knowledge Description * </label>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    {{Form::textarea('knowledge_description', $new?'':$video->knowledgeProduct->knowledge_description,['class'=>'form-control','placeholder'=>'', ])}}
                                    <div class="form-control-feedback">
                                        <i class="icon-text-width"></i>
                                    </div>
                                </div>
                            </div>

                            <label class="form-text text-muted col-sm-12">Select Video Files</label>
                            <legend class="mt-0 p-0"></legend>

                            <div class="col-md-6 col-lg-4" id="file">
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
                </fieldset>
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
<script src="{{ asset('global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>
<script src="{{ asset('js/script.js')}}"></script>

<script>
    function addForm(){
            event.preventDefault();
            $('#formDiv').append($('#file').clone());
        }

</script>
@endsection