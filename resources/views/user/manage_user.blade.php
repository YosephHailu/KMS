@extends('layouts.app')

@section('content')

@section('breadcrumb')

<a href="{{url('users')}}" class="breadcrumb-item"> Users</a>
<span class="breadcrumb-item active">{{$new?'Add User': 'Edit User Profile'}}</span>
@endsection

<div class="content">
    <div class="card">
        @if (!$new)
        {!! Form::open(['action' => ['UserController@update',$user->id], 'method'=> 'POST',
        'enctype'=>'multipart/form-data']) !!}
        @else
        {!! Form::open(['action' => ['UserController@store'], 'method'=> 'POST','enctype'=>'multipart/form-data']) !!}
        @endif
        <div class="card-body p-0">
            <div class="card-header bg-blue pb-0">
                <legend class="text-uppercase text-center font-size-sm font-weight-bold">User Registration Form</legend>
            </div>
            <div class="form-group p-1 row">
                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Full Name * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('name', $new?'':$user->name,['class'=>'form-control', 'placeholder'=>'E.g : Joseph Mekonen'])}}
                            <div class="form-control-feedback">
                                <i class="icon-text-width"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 m-0">
                        <label class="form-text text-muted">Job * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('job_title', $new?'':$user->job_title,['class'=>'form-control','placeholder'=>'E.g : Manager, Knowledge Creator'])}}
                            <div class="form-control-feedback">
                                <i class="icon-office"></i>
                            </div>
                        </div>
                    </div>

                    @if($new)
                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Directorate</label>
                        <div class="form-group">
                            {{Form::select('directorate_id', App\Directorate::pluck('name','id'), $new?null:$user->directorate_id, 
                                    ['class'=>'form-control select-search'])}}
                        </div>
                    </div>
                    @else
                    @can('updateDirectorate', $user)
                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Directorate</label>
                        <div class="form-group">
                            {{Form::select('directorate_id', App\Directorate::pluck('name','id'), $new?null:$user->directorate_id, 
                                    ['class'=>'form-control select-search'])}}
                        </div>
                    </div>
                    @endcan
                    @endif

                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Phone Number * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('phone', $new?'':$user->phone,['class'=>'form-control', 'data-mask'=>'(999) 999-9999','placeholder'=>'E.g : (099) 999-9999'])}}
                            <div class="form-control-feedback">
                                <i class="icon-phone"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Email * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('email', $new?'':$user->email,['class'=>'form-control','placeholder'=>'Enter valid email address'])}}
                            <div class="form-control-feedback">
                                <i class="icon-mail5"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Username * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('username', $new?'':$user->username,['class'=>'form-control','placeholder'=>'Enter Unique Username'])}}
                            <div class="form-control-feedback">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                    </div>

                    @if($new)
                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Password * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('password', '', ['class'=>'form-control','placeholder'=>'Enter Password'])}}
                            <div class="form-control-feedback">
                                <i class="icon-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Confirm Password * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::text('password_confirmation', '', ['class'=>'form-control','placeholder'=>'Confirm Password'])}}
                            <div class="form-control-feedback">
                                <i class="icon-lock"></i>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">Profile Picture </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::file('picture',['class'=>'form-control '])}}
                            <div class="form-control-feedback">
                                <i class="icon-camera"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">User Access Level</label>
                        <div class="form-group">
                            {{Form::select('access_level_id', App\AccessLevel::pluck('level','id'), $new?null:$user->access_level_id, 
                                    ['class'=>'form-control select-search'])}}
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <label class="form-text text-muted">User Status * </label>
                        <div class="form-group form-group-feedback form-group-feedback-left">
                            {{Form::select('user_status_id', App\UserStatus::pluck('status','id'), $new?null:$user->user_status_id, 
                                    ['class'=>'form-control select-search'])}}
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