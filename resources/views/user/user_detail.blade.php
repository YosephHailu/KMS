@extends('layouts.app')

@section('content')

@section('breadcrumb')

<a href="{{url('users')}}" class="breadcrumb-item"> {{__('app.nav_directorate_users')}}</a>
<span class="breadcrumb-item active">{{$user->name}}</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

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
					<!-- Basic view -->
					<div class="card m-t-2 col-md-12">
						<div class="card-header header-elements-inline">
							<h5 class="card-title">User Activities</h5>
							<div class="header-elements">
								<div class="list-icons">
									<a class="list-icons-item" data-action="collapse"></a>
								</div>
							</div>
						</div>

						<div class="card-body">
							<div class="fullcalendar-basic" id="fullcalendar"></div>
						</div>
					</div>
					<!-- /basic view -->
				</div>
			</div>
			<!-- Right sidebar component -->
			<div class="col-lg-4 col-md-12">

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
									<span class="badge bg-danger badge-pill ml-auto">{{number_format($user->userLog->count())}}</span>
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

				<!-- /navigation -->
				<div class="card bg-white mt-2">
					<div class="card-header header-elements-inline">
						<h6 class="card-title">Your Roles</h6>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Role</th>
									<th class="text-center" style="width: 100px;">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($user->roles as $role)
								<tr data-toggle="context" data-target=".context-table-row">
									<td><a href="#">{{$role->name}}</a></td>
									<td class="text-center">
										<div class="list-icons">
											<button class=" btn list-icons-item text-danger"
												onclick="deleteRole({{$user->id}}, '{{$role->name}}')">
												<i class="icon-trash"></i>
											</button>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@if (Auth::user()->hasAnyPermission('all'))
					<div class="card-body">
						{!! Form::open(['action' => ['UserController@assignRole',$user->id], 'method'=> 'POST',
						'enctype'=>'multipart/form-data']) !!}
						<label class="form-text text-muted">Assign Role</label>
						<div class="form-group">
							{{Form::select('role_id', Spatie\Permission\Models\Role::pluck('name','id'), null, 
									['class'=>'form-control select-search col-md-12', 
									'placeholder' => '--- Select Role ---'])}}
						</div>
						{{Form::submit('Assign Role',['class'=>'btn btn-primary float-right mt-1'])}}
						{!! Form::close() !!}
					</div>
					@elseif(Auth::user()->hasAnyPermission('manage directorate'))
					<div class="card-body">
						{!! Form::open(['action' => ['UserController@assignRole',$user->id], 'method'=> 'POST',
						'enctype'=>'multipart/form-data']) !!}
						<label class="form-text text-muted">Share Your Role</label>
						<div class="form-group">
							{{Form::select('role_id', Spatie\Permission\Models\Role::whereIn('name', Auth::user()->getRoleNames())->pluck('name','id'), null, 
										['class'=>'form-control select-search col-md-12', 
										'placeholder' => '--- Select Role ---'])}}
						</div>
						{{Form::submit('Assign Role',['class'=>'btn btn-primary float-right mt-1'])}}
						{!! Form::close() !!}
					</div>
					@endif
				</div>
				<!-- Latest Document Uploads -->
				<div class="card bg-white mt-3">
					<div class="card-header bg-transparent header-elements-inline">
						<span class="card-title font-weight-semibold">Latest document uploads</span>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>

					<ul class="media-list media-list-linked my-2">
						@foreach ($user->knowledgeProduct->take(7) as $knowledge)
						<li>
							<a href="{{url('knowledge/'.$knowledge->id)}}" class="media pt-0">
								<div class="media-body ">
									<div class="media-title ">{{$knowledge->title}}</div>
									<span
										class="text-muted font-size-sm">{{$knowledge->knowledgeCategory->category}}</span>
								</div>
							</a>
						</li>
						@endforeach
					</ul>
				</div>
				<!-- /latest Document Uploads -->
			</div>
			<!-- /right sidebar component -->
		</div>

		<!-- /inner container -->
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
				<h5 class="modal-title">Delete!!</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete role information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn danger btn-delete-role-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

@endsection

@section('script')
<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/ui/fullcalendar/fullcalendar.min.js')}}"></script>

<script>
	var serviceID = 0;
	var token = '{{Session::token()}}';
	var url = "{{url('userActivitiesJson')}}/"+{{$user->id}}; 
	var base_url = "{{url('')}}"; 
	var userId = 0;
	var _role = "";


// Setup module
// ------------------------------

var FullCalendarBasic = function () {


//
// Setup module components
//

// Basic calendar
var _componentFullCalendarBasic = function (events) {
	if (!$().fullCalendar) {
		console.warn('Warning - fullcalendar.min.js is not loaded.');
		return;
	}

	// Initialization
	// ------------------------------

	// Basic view
	$('.fullcalendar-basic').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: true,
		events: events,
		eventLimit: true,
		isRTL: $('html').attr('dir') == 'rtl' ? true : false
	});

	// Agenda view
	$('.fullcalendar-agenda').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		defaultDate: '2014-11-12',
		defaultView: 'agendaWeek',
		editable: true,
		businessHours: true,
		events: events,
		isRTL: $('html').attr('dir') == 'rtl' ? true : false
	});

	// List view
	$('.fullcalendar-list').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'listDay,listWeek,listMonth'
		},
		views: {
			listDay: {
				buttonText: 'Day'
			},
			listWeek: {
				buttonText: 'Week'
			},
			listMonth: {
				buttonText: 'Month'
			}
		},
		defaultView: 'listMonth',
		defaultDate: '2014-11-12',
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: events,
		isRTL: $('html').attr('dir') == 'rtl' ? true : false
	});
};


//
// Return objects assigned to module
//

return {
	init: function () {

		$(document).ready(function () {
			events = [];
			$.ajax({
				method: 'get',
				url: url,
				data: {
					_token: token
				}
			}).done(function (response) {
				// console.log(response);
				$.each(JSON.parse(response), function (index, value) {
					// console.log(value);
					events.push({
						'title': value.action,
						'start': value.created_at,
						'url': base_url + '/' + value.affected_url
					});
				});
				// console.log(response);

				_componentFullCalendarBasic(events);
			}).fail(function (msg) {
				console.log(msg);
			});
		});

	}
}
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
FullCalendarBasic.init();
});



	function deleteRole(id, role){
		userId = id;
		_role = role;
        // alert(id);
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-role-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('revokeRole')}}/"+userId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token, role: _role}
        }).done(function(msg){
            console.log(msg);
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });
</script>
{{-- <script src="{{ asset('js/fullcalendar_user_activity.js')}}"></script> --}}

@endsection