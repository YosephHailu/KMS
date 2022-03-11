@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">Contact</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">
		<!-- Registration form -->
		<div class="card p-2">

			<div class="row">
				<div class="col-sm-4">
					<a href="{{url('contact/create')}}" class="btn bg-blue">Add Contact</a>
				</div>
			</div>
		</div>
		<!-- /Registration form -->
		<div class="card pt-2">

			<table class="table datatable-scroll-y" width="100%" id="myTable">
				<thead class="bg-blue">
					<tr>
						<th>Id</th>
						<th>Office</th>
						<th>Manager</th>
						<th>Phone</th>
						<th>Fax</th>
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
				<h5 class="modal-title">Delete Contact</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete contact information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-contactconfirm p-x-md"
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
	var contactId = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		let table = $('#myTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! url('contactTableData') !!}',
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'office', name: 'office' },
				{ data: 'manager', name: 'manager' },
				{ data: 'phone', name: 'phone' },
				{ data: 'fax', name: 'fax' },
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

	
    function deleteContact(id){
        event.preventDefault();
        contactId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-contactconfirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('contact')}}/"+contactId; 
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
            console.log(msg);
        });
    });
</script>
@endsection