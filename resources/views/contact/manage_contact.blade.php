@extends('layouts.app')

@section('content')

@section('breadcrumb')

<a href="{{url('contacts')}}" class="breadcrumb-item"> Contacts</a>
<span class="breadcrumb-item active">{{$new?'Add Contact': 'Edit Contact Profile'}}</span>
@endsection

<div class="content">
    <div class="card">
        @if (!$new)
        {!! Form::open(['action' => ['ContactController@update',$contact->id], 'method'=> 'POST',
        'enctype'=>'multipart/form-data']) !!}
        @else
        {!! Form::open(['action' => ['ContactController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data'])
        !!}
        @endif
        <div class="card-body p-0">
            <div class="card-header bg-blue pb-0">
                <legend class="text-uppercase text-center font-size-sm font-weight-bold">Contact Registration Form
                </legend>
            </div>
            <div class="form-group p-1">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="form-text text-muted">Office Name * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('office', $new?'':$contact->office,['class'=>'form-control'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-text-width"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-text text-muted">Manager * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('manager', $new?'':$contact->manager,['class'=>'form-control'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-office"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-text text-muted">Phone Number * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('phone', $new?'':$contact->phone,['class'=>'form-control', 'data-mask'=>'(999) 999-9999','placeholder'=>'E.g : (099) 999-9999'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-phone"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <label class="form-text text-muted">Fax </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('fax', $new?'':$contact->fax,['class'=>'form-control'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-office"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label class="form-text text-muted">Remark * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::textarea('remark', $new?'':$contact->remark,['class'=>'form-control', 'col'=>'2'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-contact"></i>
                                </div>
                            </div>
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
</div>
@endsection
@section('script')
<script src="{{ asset('global_assets/js/demo_pages/form_select2.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/inputs/inputmask.js')}}"></script>
@endsection