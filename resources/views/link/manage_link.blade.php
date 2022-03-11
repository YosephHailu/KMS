@extends('layouts.app')

@section('content')

@section('breadcrumb')

<a href="{{url('link')}}" class="breadcrumb-item"> Important Links</a>
<span class="breadcrumb-item active">{{$new?'Add Link': 'Edit Link'}}</span>
@endsection

<div class="content-wrapper">
    <div class="card">

        <div class="card-header bg-blue pb-0">
            @if (!$new)
            <legend class="text-uppercase text-center font-weight-bold">Important Link Edit Form</legend>
            {!! Form::open(['action' => ['LinkController@update',$link->id], 'method'=> 'POST',
            'enctype'=>'multipart/form-data']) !!}
            @else
            <legend class="text-uppercase text-center font-weight-bold">Important Link Registration Form</legend>
            {!! Form::open(['action' => ['LinkController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data'])
            !!}
            @endif
        </div>

        <div class="card-body">
            <fieldset class="mb-3">
                <div class="form-group row">
                    <div class="input-label col-md-6">
                        {{Form::label('name', 'Name *' ,['class'=>'text-muted m-1'])}}
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('name', $new?'':$link->name,['class'=>'form-control', 'placeholder'=> 'Google, Wikipedia..'])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input-label col-md-6">
                        {{Form::label('link', 'Link/Url *' ,['class'=>'text-muted m-1'])}}
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('link', $new?'':$link->link,['class'=>'form-control', 'placeholder'=> 'E.g : https://www.google.com/...'])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="card-footer">
            <a href="{{url()->previous()}}" class="btn btn-info pull-left">Cancel-/-Back</a>
            @if (!$new)
            {{Form::hidden('_method','PUT')}}
            @endif
            {{Form::submit($new?'Save':'Update',['class'=>'btn btn-primary float-right'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection