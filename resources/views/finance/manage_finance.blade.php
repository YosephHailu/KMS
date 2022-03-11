@extends('layouts.app')

@section('content')

@section('breadcrumb')

<a href="{{url('finance')}}" class="breadcrumb-item"> Finance</a>
<span class="breadcrumb-item active">{{$new?'Add Finance Information': 'Edit Finance Information'}}</span>
@endsection

<div class="content-wrapper">
    <div class="card">
        <div class="card-header bg-blue pb-0">
            @if ($new)
            <legend class="text-uppercase text-center font-weight-bold">Finance Source Registration Form</legend>
            @else
            <legend class="text-uppercase text-center font-weight-bold">Finance Source Edit Form</legend>
            @endif
        </div>
        <div class="card-body">

            @if (!$new)
            {!! Form::open(['action' => ['FinanceController@update',$finance->id], 'method'=> 'POST',
            'enctype'=>'multipart/form-data']) !!}
            @else
            {!! Form::open(['action' => ['FinanceController@store'], 'method'=>
            'POST','enctype'=>'multipart/form-data']) !!}
            @endif
            <fieldset class="mb-3">
                <div class="form-group row">
                    <div class="input-label col-md-6 col-lg-4">
                        {{Form::label('name', 'Donner Name *' ,['class'=>'text-muted m-1'])}}
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('donner_name', $new?'':$finance->donner_name,['class'=>'form-control', 'placeholder'=> 'E.g : World Bank, Water Aid...'])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-label col-md-6 col-lg-4 mt-0">
                        {{Form::label('credit', 'Credit ' ,['class'=>'text-muted m-1'])}}
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('credit', $new?'':$finance->credit,['class'=>'form-control', 'placeholder'=> 'Bank Account Number'])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-label col-md-6 col-lg-4">
                        {{Form::label('contact', 'Contact *' ,['class'=>'text-muted m-1'])}}
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('contact', $new?'':$finance->contact,['class'=>'form-control', 'placeholder'=> 'Phone, Email...'])}}
                            <div class="form-control-feedback">
                                <i class="icon-location3"></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-label col-md-6 col-lg-4">
                        {{Form::label('address', 'Address *' ,['class'=>'text-muted m-1'])}}
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('address', $new?'':$finance->address,['class'=>'form-control', 'placeholder'=> 'Ethiopia Addis Ababa,'])}}
                            <div class="form-control-feedback">
                                <i class="icon-address-book"></i>
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