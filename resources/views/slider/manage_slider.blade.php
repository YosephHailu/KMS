
@extends('layouts.app')

@section('content')

@section('breadcrumb')
	<a href="{{url('slider')}}" class="breadcrumb-item"> Slider</a>
	<span class="breadcrumb-item active">{{$new?'Add Slider': 'Edit Slider'}}</span>	
@endsection

<div class="content-wrapper">
    <div class="card">
        <div class="card-header bg-blue pb-0">
        @if ($new)
            <legend class="text-uppercase text-center font-weight-bold">Slider Registration Form</legend>
        @else
            <legend class="text-uppercase text-center font-weight-bold">Slider Edit Form</legend>
        @endif
        </div>
        @if (!$new)
            {!! Form::open(['action' => ['SliderController@update',$slider->id], 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
        @else
            {!! Form::open(['action' => ['SliderController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
        @endif
        <div class="card-body">
                <div class="form-group row">
                    <div class="input-label col-md-6">
                        {{Form::label('title', 'Slider Title *' ,['class'=>'text-muted m-1'])}} 
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('title', $new?'':$slider->title,['class'=>'form-control', 'place holder'=> 'Slider Name'])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div> 
                    </div>
                    <div class="input-label col-md-6">
                        {{Form::label('title','Photo', ['class'=>'text-muted m-1'])}} 
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::file('attachment',['class'=>'form-control '])}}

                            <div class="form-control-feedback">
                                <i class="icon-profile"></i>
                            </div>
                        </div> 
                    </div>
                    <div class="input-label col-md-6">
                        {{Form::label('message', 'Slider Message *' ,['class'=>'text-muted m-1'])}} 
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::textarea('message', $new?'':$slider->message,['class'=>'form-control', 'rows'=>'4'])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div> 
                    </div>
                    <div class="input-label col-md-6 mt-3">
                        <div class="form-check mt-3">
                            <label class="form-check-label">
                                <input type="checkbox"  name="active_now" class="form-input-styled" {{$new?'checked':($slider->active?'checked':'')}} >
                                Activate Now
                            </label>
                        </div>
                    </div>
                </div>
        </div>
        
        <div class="card-footer">
            <a href="{{url()->previous()}}" class="btn btn-info pull-left">Cancel-/-Back</a>
                @if (!$new)
                    {{Form::hidden('_method','PUT')}}
                @endif
                    {{Form::submit($new?'Save':'Update',['class'=>'btn btn-primary float-right'])}}
        </div>
        {!! Form::close() !!}

    </div>
</div>
@endsection
@section('script')
	<script src="{{ asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/demo_pages/login.js')}}"></script>
@endsection