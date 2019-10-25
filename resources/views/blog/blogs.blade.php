@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">News</span>
@endsection

<!-- Main content -->
<div class="content">
	<!-- Page Buttons -->
	<div class="card p-2">
		<div class="row">
			<div class="col-sm-4">
				<a href="{{url('news/create')}}" class="btn bg-blue">Add News</a>
			</div>
		</div>
	</div>
	<!-- /Page Buttons -->

	<div class="card pt-2">
		<table class="table datatable-scroll-y" width="100%" id="myTable">
			<thead class="bg-blue">
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Message</th>
					<th>User</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
	<!-- /scrollable datatable -->
</div>

<!-- .modal -->
<div id="modal-confirm-deletion" class="modal modal-danger fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete News Information</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to Delete News</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn danger btn-delete-blog-confirm p-x-md"
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
	var blogId = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		let table = $('#myTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! url('newsTableData') !!}',
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'title', name: 'title' },
				{ data: 'adj_message', name: 'adj_message' },
				{ data: 'user', name: 'user' },
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
	
    function deleteBlog(id){
		event.preventDefault();
        blogId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-blog-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('news')}}/"+blogId; 
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