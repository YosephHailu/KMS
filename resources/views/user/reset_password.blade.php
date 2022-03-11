
@extends('layouts.app')

@section('content')

@section('breadcrumb')
	
	<a href="{{url('users')}}" class="breadcrumb-item"> Users</a>
	<span class="breadcrumb-item active">Reset Password</span>	
@endsection

<div class="content">
    <div class="card">
        {!! Form::open(['action' => ['UserController@updatePassword', $user->id], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
        <div class="card-body p-0">
            <div class="card-header bg-blue pb-0">
                <legend class="text-uppercase text-center font-size-sm font-weight-bold">{{ __('Reset Password') }}</legend>
            </div>
            <div class="form-group p-1">
                <div class="col-md-12">
                    <div class="form-group row">
                               
                        <div class="col-md-6">
                            <label class="form-text text-muted">Old Password * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('old_password', '', ['class'=>'form-control','placeholder'=>'Enter Password'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-text text-muted">New Password * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::password('password', ['class'=>'form-control','placeholder'=>'Enter Password'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-text text-muted">Confirm Password * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Confirm Password'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{url()->previous()}}" class="btn btn-info ">Cancel-/-Back</a>
                {{Form::submit('RESET PASSWORD',['class'=>'btn btn-primary float-right'])}}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
	<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>    
    <script src="{{ asset('global_assets/js/plugins/forms/inputs/inputmask.js')}}"></script>    
    <script>
        $('.select-search').select2()
    </script>
@endsection