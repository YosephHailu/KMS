@extends('layouts.app')

@section('content')

<!-- Main content -->
<div class="content-wrapper">

    <!-- Content area -->
    <div class="row">
        <div class="card col-md-6 col-lg-4 float-left p-0">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title font-weight-semibold">
                    <i class="icon-people mr-2"></i>
                    User Statuses
                </h6>
            </div>

            <div class="list-group list-group-flush">
                @foreach (App\UserStatus::All() as $userStatus)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$userStatus->status}} <span
                        class="badge bg-success-400 ml-auto">{{\Carbon\Carbon::parse($userStatus->created_at)->format('d, M, Y')}}</span>
                    <span class="btn btn-delete-userStatus" id="{{$userStatus->id}}"> <i
                            class="icon-trash	text-danger"></i></span>
                </a>
                @endforeach
            </div>
            <div class="card-footer bg-blue">
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::open(['action' => 'UserStatusController@store', 'method'=> 'POST',
                        'enctype'=>'multipart/form-data']) !!}

                        <label class="col-form-label">Add User Status</label>
                        <div class="input-group">
                            {{Form::text('status', '',['class'=>'form-control', 'placeholder' => 'Status Name'])}}
                            <span class="input-group-append">
                                {{Form::submit('Save',['class'=>'btn btn-white float-right'])}}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="card col-md-6 col-lg-4 float-left  p-0">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title font-weight-semibold">
                    <i class="icon-menu4 mr-2"></i>
                    Document Category
                </h6>
            </div>

            <div class="list-group list-group-flush">
                @foreach (App\DocumentCategory::All() as $documentCategory)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$documentCategory->category}} <span
                        class="badge bg-success-400 ml-auto">{{\Carbon\Carbon::parse($documentCategory->created_at)->format('d, M, Y')}}</span>
                    <span class="btn btn-delete-documentCategory" id="{{$documentCategory->id}}"> <i
                            class="icon-trash	text-danger"></i></span>
                </a>
                @endforeach
            </div>
            <div class="card-footer bg-blue">
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::open(['action' => 'DocumentCategoryController@store', 'method'=> 'POST',
                        'enctype'=>'multipart/form-data']) !!}

                        <label class="col-form-label">Add Document Category</label>
                        <div class="input-group">
                            {{Form::text('category', '',['class'=>'form-control', 'placeholder' => 'Enter Category Name'])}}
                            <span class="input-group-append">
                                {{Form::submit('Save',['class'=>'btn btn-white float-right'])}}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="card float-left col-md-6 col-lg-4 p-0">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title font-weight-semibold">
                    <i class="icon-menu4 mr-2"></i>
                    Project Category
                </h6>
            </div>

            <div class="list-group list-group-flush">
                @foreach (App\ProjectCategory::All() as $projectCategory)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$projectCategory->category}} <span
                        class="badge bg-success-400 ml-auto">{{\Carbon\Carbon::parse($projectCategory->created_at)->format('d, M, Y')}}</span>
                    <span class="btn btn-delete-projectCategory" id="{{$projectCategory->id}}"> <i
                            class="icon-trash	text-danger"></i></span>
                </a>
                @endforeach
            </div>
            <div class="card-footer bg-blue">
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::open(['action' => 'ProjectCategoryController@store', 'method'=> 'POST',
                        'enctype'=>'multipart/form-data']) !!}

                        <label class="col-form-label">Add Project Category</label>
                        <div class="input-group">
                            {{Form::text('category', '',['class'=>'form-control', 'placeholder' => 'Enter Category Name'])}}
                            <span class="input-group-append">
                                {{Form::submit('Save',['class'=>'btn btn-white float-right'])}}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="card float-left col-md-6 col-lg-4 p-0">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title font-weight-semibold">
                    <i class="icon-menu4 mr-2"></i>
                    Project Status
                </h6>
            </div>

            <div class="list-group list-group-flush">
                @foreach (App\ProjectStatus::All() as $projectStatus)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$projectStatus->status}} <span
                        class="badge bg-success-400 ml-auto">{{\Carbon\Carbon::parse($projectStatus->created_at)->format('d, M, Y')}}</span>
                    <span class="btn btn-delete-projectStatus" id="{{$projectStatus->id}}"> <i
                            class="icon-trash	text-danger"></i></span>
                </a>
                @endforeach
            </div>
            <div class="card-footer bg-blue">
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::open(['action' => 'ProjectStatusController@store', 'method'=> 'POST',
                        'enctype'=>'multipart/form-data']) !!}

                        <label class="col-form-label">Add Project Status</label>
                        <div class="input-group">
                            {{Form::text('status', '',['class'=>'form-control', 'placeholder' => 'Enter Status'])}}
                            <span class="input-group-append">
                                {{Form::submit('Save',['class'=>'btn btn-white float-right'])}}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="card float-left col-md-6 col-lg-4 p-0">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title font-weight-semibold">
                    <i class="icon-menu4 mr-2"></i>
                    Regions
                </h6>
            </div>

            <div class="list-group list-group-flush">
                @foreach (App\Region::All() as $region)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$region->name}} <span
                        class="badge bg-success-400 ml-auto">{{\Carbon\Carbon::parse($region->created_at)->format('d, M, Y')}}</span>
                    <span class="btn btn-delete-region" id="{{$region->id}}"> <i
                            class="icon-trash	text-danger"></i></span>
                </a>
                @endforeach
            </div>
            <div class="card-footer bg-blue">
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::open(['action' => 'RegionController@store', 'method'=> 'POST',
                        'enctype'=>'multipart/form-data']) !!}

                        <label class="col-form-label">Add Region</label>
                        <div class="input-group">
                            {{Form::text('name', '',['class'=>'form-control', 'placeholder' => 'Enter Region Name'])}}
                            <span class="input-group-append">
                                {{Form::submit('Save',['class'=>'btn btn-white float-right'])}}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="card float-left col-md-6 col-lg-4 p-0">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title font-weight-semibold">
                    <i class="icon-menu4 mr-2"></i>
                    Map Type
                </h6>
            </div>

            <div class="list-group list-group-flush">
                @foreach (App\MapType::All() as $mapType)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$mapType->type}} <span
                        class="badge bg-success-400 ml-auto">{{\Carbon\Carbon::parse($mapType->created_at)->format('d, M, Y')}}</span>
                    <span class="btn btn-delete-mapType" id="{{$mapType->id}}"> <i
                            class="icon-trash	text-danger"></i></span>
                </a>
                @endforeach
            </div>
            <div class="card-footer bg-blue">
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::open(['action' => 'MapTypeController@store', 'method'=> 'POST',
                        'enctype'=>'multipart/form-data']) !!}

                        <label class="col-form-label">Add Map Type</label>
                        <div class="input-group">
                            {{Form::text('type', '',['class'=>'form-control', 'placeholder' => 'Enter Type'])}}
                            <span class="input-group-append">
                                {{Form::submit('Save',['class'=>'btn btn-white float-right'])}}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="card float-left col-md-6 col-lg-4 p-0">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title font-weight-semibold">
                    <i class="icon-menu4 mr-2"></i>
                    Language
                </h6>
            </div>

            <div class="list-group list-group-flush">
                @foreach (App\Language::All() as $language)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$language->name}} <span class="badge bg-success-400 ml-auto">{{$language->abbreviation}}</span>
                    <span class="btn btn-delete-language" id="{{$language->id}}"> <i
                            class="icon-trash	text-danger"></i></span>
                </a>
                @endforeach
            </div>
            <div class="card-footer bg-blue">
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::open(['action' => 'LanguageController@store', 'method'=> 'POST',
                        'enctype'=>'multipart/form-data']) !!}

                        <label class="col-form-label">Add Language</label>
                        <div class="input-group">
                            {{Form::text('name', '',['class'=>'form-control', 'placeholder' => 'Enter Name'])}}
                        </div>
                        <div class="input-group mt-2">
                            {{Form::text('abbreviation', '',['class'=>'form-control', 'placeholder' => 'Enter Abbreviation'])}}
                            <span class="input-group-append">
                                {{Form::submit('Save',['class'=>'btn btn-white float-right'])}}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="card float-left col-md-6 col-lg-4 p-0">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title font-weight-semibold">
                    <i class="icon-menu4 mr-2"></i>
                    Unit
                </h6>
            </div>

            <div class="list-group list-group-flush">
                @foreach (App\Unit::All() as $unit)
                <a href="#" class="list-group-item list-group-item-action">
                    {{$unit->name}}
                    <span class="btn btn-delete-unit" id="{{$unit->id}}"> <i
                            class="icon-trash	text-danger"></i></span>
                </a>
                @endforeach
            </div>
            <div class="card-footer bg-blue">
                <div class="form-group row">
                    <div class="col-md-12">
                        {!! Form::open(['action' => 'UnitController@store', 'method'=> 'POST']) !!}

                        <label class="col-form-label">Add Unit</label>
                        <div class="input-group mt-2">
                            {{Form::text('name', '',['class'=>'form-control', 'placeholder' => 'Enter Unit Name'])}}
                            <span class="input-group-append">
                                {{Form::submit('Save',['class'=>'btn btn-white float-right'])}}
                            </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /dashboard content -->

    </div>
    <!-- /content area -->

</div>
<!-- /main content -->


<!-- .modal -->
<div id="modal-confirm-deletion" class="modal fade animate" data-backdrop="true" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog zoom" id="animate" ui-class="zoom">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
            </div>
            <div class="modal-body">
                <p>Press continue to delete</p>
            </div>

            <div class="modal-footer" style="clear:both">
                <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-delete-userStatus-confirm p-x-md"
                    data-dismiss="modal">Continue</button>
                <button type="button" class="btn btn-danger btn-delete-projectCategory-confirm p-x-md"
                    data-dismiss="modal">Continue</button>
                <button type="button" class="btn btn-danger btn-delete-documentCategory-confirm p-x-md"
                    data-dismiss="modal">Continue</button>
                <button type="button" class="btn btn-danger btn-delete-projectStatus-confirm p-x-md"
                    data-dismiss="modal">Continue</button>
                <button type="button" class="btn btn-danger btn-delete-region-confirm p-x-md"
                    data-dismiss="modal">Continue</button>
                <button type="button" class="btn btn-danger btn-delete-mapType-confirm p-x-md"
                    data-dismiss="modal">Continue</button>
                <button type="button" class="btn btn-danger btn-delete-language-confirm p-x-md"
                    data-dismiss="modal">Continue</button>
                <button type="button" class="btn btn-danger btn-delete-unit-confirm p-x-md"
                    data-dismiss="modal">Continue</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!-- / .modal -->

@endsection

@section('script')

<script>
    var userStatusId = 0;
	var projectCategoryId = 0;
	var documentCategoryId = 0;
	var projectStatusId = 0;
	var regionId = 0;
	var mapTypeId = 0;
	var languageId = 0;
	var unitId = 0;
	var token = '{{Session::token()}}';

    $('.btn-delete-userStatus').on('click', function(event){
        event.preventDefault();
        $('.btn-delete-userStatus-confirm').show();
        $('.btn-delete-projectCategory-confirm').hide();
        $('.btn-delete-projectStatus-confirm').hide();
        $('.btn-delete-documentCategory-confirm').hide();
        $('.btn-delete-mapType-confirm').hide();
        $('.btn-delete-language-confirm').hide();
        $('.btn-delete-unit-confirm').hide();
        $('.btn-delete-region-confirm').hide();
        userStatusId = this.id;
        $('#modal-confirm-deletion').modal();
    });
    
    $('.btn-delete-projectCategory').on('click', function(event){
        event.preventDefault();
        $('.btn-delete-userStatus-confirm').hide();
        $('.btn-delete-projectStatus-confirm').hide();
        $('.btn-delete-documentCategory-confirm').hide();
        $('.btn-delete-region-confirm').hide();
        $('.btn-delete-mapType-confirm').hide();
        $('.btn-delete-language-confirm').hide();
        $('.btn-delete-unit-confirm').hide();
        $('.btn-delete-projectCategory-confirm').show();
        projectCategoryId = this.id;
        $('#modal-confirm-deletion').modal();
    });
    
    $('.btn-delete-documentCategory').on('click', function(event){
        event.preventDefault();
        $('.btn-delete-userStatus-confirm').hide();
        $('.btn-delete-documentCategory-confirm').show();
        $('.btn-delete-projectStatus-confirm').hide();
        $('.btn-delete-projectCategory-confirm').hide();
        $('.btn-delete-mapType-confirm').hide();
        $('.btn-delete-language-confirm').hide();
        $('.btn-delete-unit-confirm').hide();
        $('.btn-delete-region-confirm').hide();
        documentCategoryId = this.id;
        $('#modal-confirm-deletion').modal();
    });

    $('.btn-delete-projectStatus').on('click', function(event){
        event.preventDefault();
        $('.btn-delete-userStatus-confirm').hide();
        $('.btn-delete-documentCategory-confirm').hide();
        $('.btn-delete-projectStatus-confirm').show();
        $('.btn-delete-projectCategory-confirm').hide();
        $('.btn-delete-mapType-confirm').hide();
        $('.btn-delete-language-confirm').hide();
        $('.btn-delete-unit-confirm').hide();
        $('.btn-delete-region-confirm').hide();
        projectStatusId = this.id;
        $('#modal-confirm-deletion').modal();
    });
    
    $('.btn-delete-region').on('click', function(event){
        event.preventDefault();
        $('.btn-delete-userStatus-confirm').hide();
        $('.btn-delete-documentCategory-confirm').hide();
        $('.btn-delete-projectStatus-confirm').hide();
        $('.btn-delete-projectCategory-confirm').hide();
        $('.btn-delete-mapType-confirm').hide();
        $('.btn-delete-language-confirm').hide();
        $('.btn-delete-unit-confirm').hide();
        $('.btn-delete-region-confirm').show();
        regionId = this.id;
        $('#modal-confirm-deletion').modal();
    });

    $('.btn-delete-mapType').on('click', function(event){
        event.preventDefault();
        $('.btn-delete-userStatus-confirm').hide();
        $('.btn-delete-documentCategory-confirm').hide();
        $('.btn-delete-projectStatus-confirm').hide();
        $('.btn-delete-projectCategory-confirm').hide();
        $('.btn-delete-mapType-confirm').show();
        $('.btn-delete-region-confirm').hide();
        $('.btn-delete-language-confirm').hide();
        $('.btn-delete-unit-confirm').hide();
        mapTypeId = this.id;
        $('#modal-confirm-deletion').modal();
    });


    $('.btn-delete-language').on('click', function(event){
        event.preventDefault();
        $('.btn-delete-userStatus-confirm').hide();
        $('.btn-delete-documentCategory-confirm').hide();
        $('.btn-delete-projectStatus-confirm').hide();
        $('.btn-delete-projectCategory-confirm').hide();
        $('.btn-delete-language-confirm').show();
        $('.btn-delete-unit-confirm').hide();
        $('.btn-delete-mapType-confirm').hide();
        $('.btn-delete-region-confirm').hide();
        languageId = this.id;
        $('#modal-confirm-deletion').modal();
    });

    $('.btn-delete-unit').on('click', function(event){
        event.preventDefault();
        $('.btn-delete-userStatus-confirm').hide();
        $('.btn-delete-documentCategory-confirm').hide();
        $('.btn-delete-projectStatus-confirm').hide();
        $('.btn-delete-projectCategory-confirm').hide();
        $('.btn-delete-language-confirm').hide();
        $('.btn-delete-unit-confirm').show();
        $('.btn-delete-mapType-confirm').hide();
        $('.btn-delete-region-confirm').hide();
        unitId = this.id;
        $('#modal-confirm-deletion').modal();
    });

    $('.btn-delete-unit-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('unit')}}/"+unitId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });

    $('.btn-delete-language-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('language')}}/"+languageId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });

    $('.btn-delete-mapType-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('mapType')}}/"+mapTypeId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });

    $('.btn-delete-projectStatus-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('projectStatus')}}/"+projectStatusId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });

    $('.btn-delete-region-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('region')}}/"+regionId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });

    $('.btn-delete-documentCategory-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('documentCategory')}}/"+documentCategoryId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });

    $('.btn-delete-projectCategory-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('projectCategory')}}/"+projectCategoryId; 
        alert(url);
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });

    $('.btn-delete-userStatus-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('userStatus')}}/"+userStatusId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });
</script>
@endsection