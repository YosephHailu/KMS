
@extends('layouts.app')

@section('header')

     
@endsection

@section('content')

@section('breadcrumb')
	
	<a href="{{url('news')}}" class="breadcrumb-item"> News</a>
	<span class="breadcrumb-item active">{{$new?'Add News': 'Edit News'}}</span>	
@endsection

<div class="card content">
       
    @if (!$new)
        {!! Form::open(['action' => ['BlogController@update',$blog->id], 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
    @else
        {!! Form::open(['action' => ['BlogController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
    @endif
        <div class="card-body p-0">
            <fieldset >
                <div class="card-header text-center bg-blue pb-0">
                    <i class="icon-pencil6"></i>
                    <legend class="text-uppercase font-size-sm font-weight-bold">Blog Registration Form</legend>
                </div>
                <div class="col-md-12 pt-2">
                    <div class=" row"  id="formDiv">
                        <div class="col-4">
                            <label class="form-text text-muted">News Title * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('title', $new?'':$blog->title,['class'=>'form-control', 'placeholder'=>''])}}
                                <div class="form-control-feedback">
                                    <i class="icon-text-width"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="form-text text-muted">Sub Title * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('sub_title', $new?'':$blog->sub_title,['class'=>'form-control', 'placeholder'=>''])}}
                                <div class="form-control-feedback">
                                    <i class="icon-text-width"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <label class="form-text text-muted">News Photo * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::file('picture',['class'=>'form-control '])}}
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-text text-muted">Message * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::textarea('message', $new?'':$blog->message,['class'=>'form-control', 'placeholder'=>''])}}
                                <div class="form-control-feedback">
                                    <i class="icon-text-width"></i>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </fieldset>                
        </div>
        <div class="card-footer">
            <a href="{{url()->previous()}}" class="btn btn-info ">Cancel-/-Back</a>
            @if (!$new)
                {{Form::hidden('_method','PUT')}}
            @endif
                {{Form::submit($new?'Save':'Update',['class'=>'btn btn-primary float-right'])}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection