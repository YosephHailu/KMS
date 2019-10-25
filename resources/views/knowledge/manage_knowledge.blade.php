
@extends('layouts.app')

@section('header')

     
@endsection

@section('content')

@section('breadcrumb')
	
	<a href="{{url('knowledge')}}" class="breadcrumb-item"> Knowledge Product</a>
	<span class="breadcrumb-item active">{{$new?'Add Knowledge Product': 'Edit Knowledge Product'}}</span>	
@endsection

 <div class="card content">
        <div class="card-header text-center bg-blue pb-0">
        <i class="icon-pencil6"></i>
        <legend class="text-uppercase font-size-sm font-weight-bold">Knowledge Product Registration Form</legend>
    </div>   
    @if (!$new)
        {!! Form::open(['action' => ['knowledgeProductController@update',$knowledge->id], 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
    @else
        {!! Form::open(['action' => ['knowledgeProductController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
    @endif
    
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                <li class="nav-item"><a href="{{url('knowledge/create')}}" class="nav-link active" >Knowledge Products</a></li>
                <li class="nav-item"><a href="#bottom-justified-tab2" class="nav-link" data-toggle="tab">Report and Plan</a></li>
                <li class="nav-item"><a href="#bottom-justified-tab2" class="nav-link" data-toggle="tab">Policy and Regulation</a></li>
                {{-- <li class="nav-item"><a href="#bottom-justified-tab2" class="nav-link" data-toggle="tab">Research and Case Study</a></li> --}}
                {{-- <li class="nav-item"><a href="#bottom-justified-tab2" class="nav-link" data-toggle="tab">Documentaries</a></li> --}}
                <li class="nav-item"><a href="#bottom-justified-tab2" class="nav-link" data-toggle="tab">Photo Gallery</a></li>
                <li class="nav-item"><a href="#bottom-justified-tab2" class="nav-link" data-toggle="tab">Map</a></li>
                <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">more</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#bottom-justified-tab3" class="dropdown-item" data-toggle="tab">Research and Case Study</a>
                            <a href="#bottom-justified-tab4" class="dropdown-item" data-toggle="tab">Documentaries</a>
                        </div>
                    </li>
            </ul>

            <div class="tab-content p-1">
                <div class="tab-pane fade show active" id="bottom-justified-tab1">
                    <fieldset >
                        <div class="col-md-12 pt-2">
                            <div class=" row"  id="formDiv">
                                <div class="col-4">
                                    <label class="form-text text-muted">Product Title * </label>
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        {{Form::text('title', $new?'':$knowledge->title,['class'=>'form-control', 'placeholder'=>''])}}
                                        <div class="form-control-feedback">
                                            <i class="icon-text-width"></i>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <label class="form-text text-muted">Directorate</label>
                                    <div class="form-group">
                                        {{Form::select('directorate_id', App\Directorate::pluck('name','id'), $new?null:$knowledge->directorate_id, 
                                            ['class'=>'form-control select-search'])}}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-text text-muted">Knowledge Category</label>
                                    <div class="form-group">
                                        {{Form::select('knowledge_category_id', App\KnowledgeCategory::pluck('category','id'), $new?null:$knowledge->knowledge_category_id, 
                                            ['class'=>'form-control select-search'])}}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-text text-muted">Source * </label>
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        {{Form::text('source', $new?'':$knowledge->source,['class'=>'form-control','placeholder'=>''])}}
                                        <div class="form-control-feedback">
                                            <i class="icon-text-width"></i>
                                        </div>
                                    </div>
                                </div>   
                                    
                                <div class="col-md-4">
                                    <label class="form-text text-muted">Contact * </label>
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        {{Form::text('contact', $new?'':$knowledge->contact,['class'=>'form-control','placeholder'=>''])}}
                                        <div class="form-control-feedback">
                                            <i class="icon-text-width"></i>
                                        </div>
                                    </div>
                                </div>   
                                    
                                <div class="col-md-4">
                                    <label class="form-text text-muted">Key Words * </label>
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        {{Form::text('keywords', $new?'':$knowledge->keywords,
                                            ['class'=>'tokenfield form-control','data-fouc','placeholder'=>'Add Keywords'])}}
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-text text-muted">Access Level</label>
                                    <div class="form-group">
                                        {{Form::select('access_level_id', App\AccessLevel::pluck('level','id'), $new?null:$knowledge->access_level_id, 
                                            ['class'=>'form-control select-search'])}}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-text text-muted">Knowledge Description * </label>
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                        {{Form::textarea('knowledge_description', $new?'':$knowledge->knowledge_description,['class'=>'form-control','placeholder'=>''])}}
                                        <div class="form-control-feedback">
                                            <i class="icon-text-width"></i>
                                        </div>
                                    </div>
                                </div>   
                                {{-- <label class="form-text text-muted col-sm-12">Project Documents </label>
                                <legend class="mt-0 p-0"></legend> 

                                <div class="col-md-4" id="file">
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        {{Form::file('picture',['class'=>'form-control '])}}
                                        <a href="#" onclick="addForm()" class="btn-add-file"><div class="form-control-feedback pt-1">
                                            <i class="icon-add"></i>
                                        </div></a>

                                    </div>
                                </div> --}}
                                
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
    <script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>            
    <script src="{{ asset('global_assets/js/plugins/pickers/daterangepicker.js')}}"></script>            
    <script src="{{ asset('global_assets/js/demo_pages/picker_date.js')}}"></script>            
    <script src="{{ asset('global_assets/js/plugins/pickers/pickadate/picker.js')}}"></script>            
    <script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>          
    <script src="{{ asset('global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>          
    <script src="{{ asset('global_assets/js/demo_pages/form_tags_input.js')}}"></script>          
    <script>
        function addForm(){
            event.preventDefault();
            $('#formDiv').append($('#file').clone());
        }

    </script>
@endsection