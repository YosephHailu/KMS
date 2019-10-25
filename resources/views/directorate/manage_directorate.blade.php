
@extends('layouts.app')

@section('content')

@section('breadcrumb')
	
	<a href="{{url('directorate')}}" class="breadcrumb-item"> Directorate</a>
	<span class="breadcrumb-item active">{{$new?'Add Directorate': 'Edit Directorate'}}</span>	
@endsection

<div class="content-wrapper">
    <div class="card">
        @if (!$new)
            {!! Form::open(['action' => ['DirectorateController@update',$directorate->id], 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(['action' => ['DirectorateController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
        @endif
        <div class="card-header bg-blue pb-0">
            <legend class="text-uppercase text-center font-size-sm font-weight-bold">Directorate Registration Form</legend>
        </div>
        <div class="card-body">
            <div class=" row">
                <div class="input-label col-md-6 col-lg-4">
                    {{Form::label('name', 'Directorate Name *' ,['class'=>'text-muted m-1'])}} 
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('name', $new?'':$directorate->name,['class'=>'form-control', 'place holder'=> 'Directorate Name'])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div> 
                </div>
                <div class="input-label col-md-6 col-lg-4">
                    {{Form::label('contact', 'Contact *' ,['class'=>'text-muted m-1'])}} 
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('contact', $new?'':$directorate->contact,['class'=>'form-control'])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div> 
                </div>
                <div class="input-label col-md-6 col-lg-4">
                    {{Form::label('manager', 'Manager *' ,['class'=>'text-muted m-1'])}} 
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('manager', $new?'':$directorate->manager,['class'=>'form-control'])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div> 
                </div>
                <div class="input-label col-md-6 col-lg-4">
                    {{Form::label('description', 'Short description Description *' ,['class'=>'text-muted m-1'])}} 
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::textarea('description', $new?'':$directorate->description,['class'=>'form-control', 'rows'=>'4'])}}
                        <div class="form-control-feedback">
                                <i class="icon-text-height"></i>
                            </div>
                    </div> 
                </div>
            </div>
        </div>
        
        <div class="card-footer">
            <a href="{{url()->previous()}}" class="btn btn-info pull-left">Cancel-/-Back</a>
                @if (!$new)
                    {{Form::hidden('_method','PUT')}}
                @endif
            {{Form::submit($new?'Save':'Edit',['class'=>'btn btn-primary float-right'])}}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection