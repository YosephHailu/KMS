@extends('layouts.app')

@section('content')

@section('breadcrumb')

<a href="{{url('users')}}" class="breadcrumb-item"> Users</a>
<span class="breadcrumb-item active">{{$user->name}}</span>
@endsection


<!-- Content area -->
<div class="content">
    <!-- Inner container -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3 col-3">
                        <img class="img-fluid rounded-circle" src="{{asset('storage\user_photos\\'.$user->photo)}}"
                            width="170" height="170" alt="">
                    </div>

                    <div class=" float-left clear-both col-4">
                        <h6 class="font-weight-semibold mt-1 mb-0 text-blue">directorate</h6>
                        <span class="d-block text-muted">{{$user->directorate->name}}</span>
                        <h6 class="font-weight-semibold mt-1 mb-0 text-blue">Account Status</h6>
                        <span class="d-block text-muted">{{$user->userStatus->status}}</span>
                    </div>

                    <div class="float-right col-4">
                        <h6 class="font-weight-semibold mt-1 mb-0 text-blue">User Name</h6>
                        <span class="d-block text-muted">{{$user->username}}</span>
                        <h6 class="font-weight-semibold mt-1 mb-0 text-blue">Email Address</h6>
                        <span class="d-block text-muted">{{$user->email}}</span>
                        <h6 class="font-weight-semibold mt-1 mb-0 text-blue">Phone</h6>
                        <span class="d-block text-muted">{{$user->phone}}</span>
                    </div>

                    <h6 class="font-weight-semibold mt-1 mb-0 text-blue text-center">{{$user->name}}</h6>
                    <span class="text-muted text-center">{{$user->job_title}}</span>
                </div>
            </div>

            <!-- Single line -->
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <h6 class="card-title"><span class="text-primary"> {{$user->name}}'s</span> Activities</h6>

                    <div class="header-elements">
                        <span class="badge bg-blue">{{number_format($userLogs->count())}}</span>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="bg-danger">
                            <tr>
                                <td>Operation</td>
                                <td>Remark</td>
                                @if(Auth::user()->hasPermissionTo('all'))
                                <td>Affected Table</td>
                                @endif
                                <td>Date</td>
                            </tr>
                        </thead>
                        <tbody data-link="row" class="rowlink">
                            @foreach ($userLogs as $userLog)
                            <tr>
                                <td>
                                    <span class="table-inbox-subject"><a href="{{url(''.$userLog->affected_url)}}"
                                            class="badge bg-pink-400 mr-2">{{$userLog->operation}} </a>
                                        {{$userLog->action}}
                                        &nbsp;-&nbsp;</span>
                                    <span class="text-muted font-weight-normal"></span>
                                </td>
                                <td>
                                    {{$userLog->remark}}
                                </td>
                                @if(Auth::user()->hasPermissionTo('all'))
                                <td>
                                    {{$userLog->affected_table}}
                                </td>
                                @endif
                                <td>
                                    {{$userLog->created_at}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /table -->

            </div>
            <!-- /single line -->
        </div>


        <!-- Right sidebar component -->
        <div class="col-xl-4">
            <!-- Navigation -->
            <div class="card bg-white">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="card-title font-weight-semibold">Navigation</span>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <ul class="nav nav-sidebar my-2">
                        <li class="nav-item">
                            <a href="{{url('users/'.$user->id)}}" class="nav-link">
                                <i class="icon-user"></i>
                                profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="icon-archive"></i>
                                Knowledge Products
                                <span
                                    class="text-muted font-size-sm font-weight-normal ml-auto">{{$user->knowledgeProduct->count()}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('userActivity/'.$user->id)}}" class="nav-link">
                                <i class="icon-comment"></i>
                                User Activities
                                <span
                                    class="badge bg-danger badge-pill ml-auto">{{number_format($userLogs->count())}}</span>
                            </a>
                        </li>
                        <li class="nav-item-divider"></li>
                        @can('update', $user)
                        <li class="nav-item">
                            <a href="{{url('users/'.$user->id.'/edit')}}" class="nav-link">
                                <i class="icon-pencil4"></i>
                                Edit Profile
                            </a>
                        </li>
                        @endcan

                        @can('resetPassword', $user)
                        <li class="nav-item">
                            <a href="{{url('resetPassword/'.$user->id)}}" class="nav-link">
                                <i class="icon-pencil4"></i>
                                Change Password
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
        <!-- /right sidebar component -->
    </div>

    <!-- /inner container -->
</div>
<!-- /content area -->

@endsection

@section('script')
<script src="{{ asset('global_assets/js/demo_pages/form_select2.js')}}"></script>
{{-- <script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script> --}}

<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/ui/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{ asset('js/fullcalendar_user_activity.js')}}"></script>

<script>
    var serviceID = 0;
	var token = '{{Session::token()}}';
	var url = "{{url('userActivitiesJson')}}/"+{{$user->id}}; 
	var base_url = "{{url('')}}"; 
	var userId = 0;
	var _role = "";
</script>
@endsection