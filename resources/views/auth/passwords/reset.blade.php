
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $username ?? old('username') }}" required autocomplete="username" autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@extends('layouts.app')

@section('content')

@section('breadcrumb')
	<a href="{{url('/')}}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
	<a href="{{url('users')}}" class="breadcrumb-item"> Users</a>
	<span class="breadcrumb-item active">Change Password</span>	
@endsection

<div class="content">
    <div class="card">
        {!! Form::open(['action' => route('password.update')], 'method'=> 'POST']) !!}

        <div class="card-body p-0">
            <div class="card-header bg-blue pb-0">
                <legend class="text-uppercase text-center font-size-sm font-weight-bold">{{ __('Reset Password') }}</legend>
            </div>
            <div class="form-group p-1">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="form-text text-muted">Username * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('username', '',['class'=>'form-control','placeholder'=>'Enter Unique Username'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-text text-muted">Password * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('password', '', ['class'=>'form-control','placeholder'=>'Enter Password'])}}
                                <div class="form-control-feedback">
                                    <i class="icon-lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-text text-muted">Confirm Password * </label>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                {{Form::text('password_confirmation', '', ['class'=>'form-control','placeholder'=>'Confirm Password'])}}
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
                {{Form::submit('UPDATE PASSWORD',['class'=>'btn btn-primary float-right'])}}
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