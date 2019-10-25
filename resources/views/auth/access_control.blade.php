@extends('layouts.app')

@section('content')

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<!-- Main charts -->
		<div class="card">
			<div class="card-header pb-0 bg-blue">
				<div class="form-group row col-lg-6 col-md-12 float-left">
					<div class="col-md-12">
						{!! Form::open(['action' => 'PermissionController@storePermission', 'method'=> 'POST',
						'enctype'=>'multipart/form-data']) !!}

						<div class="input-group">
							{{Form::text('name', '',['class'=>'form-control', 'placeholder' => 'Enter permission name (E.g) Manage directorate, Create knowledge, View Knowledge'])}}
							<span class="input-group-append">
								{{Form::submit('Add Permission',['class'=>'btn btn-success float-right'])}}
							</span>
						</div>
						{!! Form::close() !!}
					</div>
				</div>

				<div class="form-group row col-lg-6 col-md-12 float-left">
					<div class="col-md-12">
						{!! Form::open(['action' => 'PermissionController@storeRole', 'method'=> 'POST',
						'enctype'=>'multipart/form-data']) !!}

						<div class="input-group">
							{{Form::text('name', '',['class'=>'form-control', 'placeholder' => 'Enter Role Name (E.g) Administrator, Knowledge Creator'])}}
							<span class="input-group-append">
								{{Form::submit('Add Role',['class'=>'btn btn-success float-right'])}}
							</span>
						</div>
						{!! Form::close() !!}
					</div>
				</div>

				<div class="mx-2">
					{!! Form::open(['action' => 'AccessLevelController@store', 'method'=> 'POST',
					'enctype'=>'multipart/form-data']) !!}

					<div class="form-group row col-md-12 col-lg-6 float-left">
						<div class="input-group">
							{{Form::text('level', '',['class'=>'form-control', 'placeholder' => 'Access Level Name (E.g) High Level, Medium Level , Low Level'])}}
						</div>
					</div>

					<div class="form-group row col-md-12 col-lg-6 float-left">
						<div class="input-group">
							{{Form::text('level_number', '',['class'=>'form-control', 'placeholder' => 'Access Level Number (N.B) This is used To Rank Document'])}}
							<span class="input-group-append">
								{{Form::submit('Add Access Level',['class'=>'btn btn-success float-right'])}}
							</span>
						</div>
					</div>
					{!! Form::close() !!}
				</div>

				<h6 class="card-title float-right mt-1">
					<a class="collapsed text-white list-icons-item" data-action="collapse" data-toggle="collapse"
						href="#collapsible-styled-group3">
					</a>
				</h6>
			</div>
			<div id="collapsible-styled-group3" class="collapse">
				<div class="card-body">
					@foreach (App\AccessLevel::All() as $access_level)
					<div class="col-md-6 col-lg-4 float-left">
						<div class="card">
							<div class="card-header bg-primary text-white header-elements-inline">
								<h6 class="card-title">{{$access_level->level}}</h6>
								<span>{{$access_level->level_number}}</span>
								<div class="header-elements">
									<div class="list-icons">
										<a class="list-icons-item btn btn-delete-access_level"
											id="{{$access_level->id}}">
											<i class="icon-trash text-white"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="card">
			<div class="box p-a table-responsive">
				<table id="example2" class="table table-bordered table-hover dataTable" role="grid"
					aria-describedby="example2_info">
					<thead>
						<tr class="text-center">
							<td class="sorting_asc"></td>
							@foreach ($roles as $role)
							<td class="sorting_asc">{{ucfirst($role->name)}}</td>
							@endforeach
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach (Spatie\Permission\Models\Permission::All() as $permission)
						<tr role="row" class="odd">
							<th class="sorting_asc">{{ucfirst($permission->name)}}</th>
							@foreach ($roles as $role)
							<td class="text-center">
								<input type="checkbox" class="has-value"
									{{$role->hasPermissionTo($permission->id)?'checked':''}} id="name" type="checkbox"
									onchange="AssignPermission({{$role->id}},{{$permission->id}},this)">
							</td>
							@endforeach
							<td class="text-center">
								<a href="#" id="{{$permission->id}}" class="delete-permission text-danger">
									<i class="icon-trash" data-toggle="tooltip" title="delete!"> </i>
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>

					<tfoot>
						<tr role="row">
							<td></td>
							@foreach ($roles as $role)

							<td class="text-center">
								<a href="#" id="{{$role->id}}" class="delete-role text-danger">
									<i class="icon-trash" data-toggle="tooltip" title="delete!"> </i>
								</a>
							</td>
							@endforeach
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

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
				<h5 class="modal-title">Delete Access Level Information</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete Access Level information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-access_level-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

<!-- .modal -->
<div id="modal-add-role-permission" class="modal fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-blue">
			<div class="modal-header">
				<h4 class="modal-title">Assign Role</h4>
			</div>
			<div class="modal-body">
				<p>Users With This Role Assigned Will Have This Permission Activated</p>

			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success btn-add-role-permission p-x-md" data-dismiss="modal">Assign
					Permissions</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>

<div id="modal-delete-role-permission" class="modal fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h4 class="modal-title">Remove Permission</h4>
			</div>
			<div class="modal-body">
				<p>Users With This Role Assigned TO Will Be Affected</p>

			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-role-permission p-x-md"
					data-dismiss="modal">Remove Permissions</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

<!-- .modal -->
<div id="modal-confirm-permission-deletion" class="modal fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete Permission Information</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete permission information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-permission-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

<!-- .modal -->
<div id="modal-confirm-role-deletion" class="modal fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete Role Information</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete Role information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-role-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

@endsection

@section('script')

<script>
	var serviceID = 0;
	var permission_id = 0;
	var role_id = 0;
	var token = '{{Session::token()}}';

    $('.delete-permission').on('click', function(event){
        event.preventDefault();
        permission_id = this.id;
        $('#modal-confirm-permission-deletion').modal();
    });
    
    $('.btn-delete-permission-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('deletePermission')}}/"+permission_id; 
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


    $('.delete-role').on('click', function(event){
        event.preventDefault();
        role_id = this.id;
        $('#modal-confirm-role-deletion').modal();
    });
    
    $('.btn-delete-role-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('deleteRole')}}/"+role_id; 
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
    
	function AssignPermission(role_ids, permission_ids, box){
		role_id = role_ids;
		permission_id = permission_ids;
		if(!box.checked){
			$('#modal-delete-role-permission').modal();
		}else{
			$('#modal-add-role-permission').modal();
		}
	}
	
	$('.btn-add-role-permission').on('click', function(){
		event.preventDefault();
		var url = "{{url('/access/assignPermission')}}"; 
		var method = "post";
		$.ajax({
			method: method,
			url: url,
			data: {role_id: role_id, permission_id: permission_id, _token: token}
		}).done(function(msg){
			console.log(msg['message']);
			location.reload();
		}).fail(function(msg){
			console.log(msg);
		});;
	});
	
	$('.btn-delete-role-permission').on('click', function(){
		event.preventDefault();
		var url = "{{url('access/removePermission')}}"; 
		var method = "delete";
		$.ajax({
			method: method,
			url: url,
			data: {role_id: role_id, permission_id: permission_id, _token: token}
		}).done(function(msg){
			console.log(msg['message']);
			location.reload();
		}).fail(function(msg){
			console.log(msg);
		});
	});

	$('.btn-delete-role-permission').on('click', function(){
		event.preventDefault();
		var url = "{{url('access/removePermission')}}"; 
		var method = "delete";
		$.ajax({
			method: method,
			url: url,
			data: {role_id: role_id, permission_id: permission_id, _token: token}
		}).done(function(msg){		 
			new PNotify({
				text: msg,
				addclass: 'bg-success border-primary'
			});
			location.reload();
		}).fail(function(msg){
			console.log(msg);
		});
	});

	$(document).ready( function () {
		var accessLevelId = 0;
		$('.btn-delete-access_level').on('click', function(event){
			event.preventDefault();
			$('.btn-delete-access_level-confirm').show();
			accessLevelId = this.id;
			$('#modal-confirm-deletion').modal();
		});
		
		$('.btn-delete-access_level-confirm').on('click', function(event){
			event.preventDefault();
			var url = "{{url('accessLevel')}}/"+accessLevelId; 
			$.ajax({
				method: 'delete',
				url: url,
				data: {_token: token}
			}).done(function(msg){
				location.reload();				 
				new PNotify({
					text: msg,
					addclass: 'bg-success border-primary'
				}); 
			}).fail(function(msg){
				console.log(msg);
			});
		});

	});
</script>
@endsection