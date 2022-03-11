@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">Users</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">
		<div class="card py-2">
			<div class="col-md-4">
				<a href="{{url('users/create')}}" class="btn bg-blue">Add User</a>
			
			</div>
		</div>
		<!-- /main charts -->
		<div class="card pt-2">

			<table class="table datatable-scroll-y" width="100%" id="myTable">
				<thead class="bg-blue">
					<tr>
						<th>Id</th>
						<th></th>
						<th>Name</th>
						<th>Job</th>
						<th>Directorate</th>
						<th>Phone</th>
						<th>Status</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
		<!-- /scrollable datatable -->


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
				<h5 class="modal-title">Delete User</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete user information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-user-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

@endsection

@section('script')
<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{ asset('global_assets/js/demo_pages/datatables_responsive.js')}}"></script>

<script>
	var serviceID = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		let table = $('#myTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! url('userTableData') !!}',
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'profile', name: 'profile' },
				{ data: 'name', name: 'name' },
				{ data: 'job_title', name: 'job_title' },
				{ data: 'directorate', name: 'directorate' },
				{ data: 'phone', name: 'phone' },
				{ data: 'user_status', name: 'user_status' },
				{ data: 'open', name: 'open', orderable: false, searchable: false },
				{ data: 'edit', name: 'edit', orderable: false, searchable: false },
				{ data: 'delete', name: 'delete', orderable: false, searchable: false },
				
			]
		});
		
		function loadTable(){
			table.ajax.reload();
		}
		
        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
	});

	
    function deleteUser(id){
        event.preventDefault();
        userId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-user-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('users')}}/"+userId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
			new PNotify({
				text: msg,
				addclass: 'bg-success border-primary'
			});
            location.reload();
        }).fail(function(msg){
			new PNotify({
				text: "Can't delete",
				addclass: 'bg-danger border-primary'
			});
        });
    });
</script>
@endsection