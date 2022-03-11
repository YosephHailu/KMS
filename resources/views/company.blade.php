@extends('layouts.app')

@section('content')

@section('breadcrumb')

<a href="{{url('companys')}}" class="breadcrumb-item"> Users</a>
@endsection

<div class="content">
    <div class="card">

        @if ($company == null?'':$company != null)
        {!! Form::open(['action' => ['CompanyController@update',$company == null?'':$company->id], 'method'=> 'POST',
        'enctype'=>'multipart/form-data']) !!}
        @else
        {!! Form::open(['action' => ['CompanyController@store'], 'method'=>
        'POST','enctype'=>'multipart/form-data']) !!}
        @endif
        <div class="card-body p-0">
            <div class="card-header bg-blue pb-0">
                <legend class="text-uppercase text-center font-size-sm font-weight-bold">User Registration Form</legend>
            </div>
            <div class="form-group p-1 row">
                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Name * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('name', $company == null?'':$company->name,['class'=>'form-control'])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 m-0">
                    <label class="form-text text-muted">Abbreviation </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('abbreviation', $company == null?'':$company->abbreviation,['class'=>'form-control'])}}
                        <div class="form-control-feedback">
                            <i class="icon-office"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 m-0">
                    <label class="form-text text-muted">Email * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('email', $company == null?'':$company->email,['class'=>'form-control'])}}
                        <div class="form-control-feedback">
                            <i class="icon-office"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 m-0">
                    <label class="form-text text-muted">Address * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('address', $company == null?'':$company->address,['class'=>'form-control'])}}
                        <div class="form-control-feedback">
                            <i class="icon-office"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Phone Number * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('phone', $company == null?'':$company->phone,['class'=>'form-control',])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Fixed Line </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('fixed_line', $company == null?'':$company->fixed_line,['class'=>'form-control',])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Fax </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('fax', $company == null?'':$company->fax,['class'=>'form-control',])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Website </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('website', $company == null?'':$company->website,['class'=>'form-control',])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Website Url </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('url', $company == null?'':$company->url,['class'=>'form-control',])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Facebook Url </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('fb_url', $company == null?'':$company->fb_url,['class'=>'form-control',])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Twitter Url </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('twitter_url', $company == null?'':$company->twitter_url,['class'=>'form-control',])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Youtube Url </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::text('youtube_url', $company == null?'':$company->youtube_url,['class'=>'form-control',])}}
                        <div class="form-control-feedback">
                            <i class="icon-text-width"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Logo * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::file('picture_logo',['class'=>'form-control '])}}
                        <div class="form-control-feedback">
                            <i class="icon-camera"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-text text-muted">Header Image * </label>
                    <div class="form-group form-group-feedback form-group-feedback-left">
                        {{Form::file('picture_header',['class'=>'form-control '])}}
                        <div class="form-control-feedback">
                            <i class="icon-camera"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{url()->previous()}}" class="btn btn-info ">Cancel-/-Back</a>
            @if ($company == null?'':$company != null)
            {{Form::hidden('_method','PUT')}}
            @endif
            {{Form::submit('Save',['class'=>'btn btn-primary float-right'])}}
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