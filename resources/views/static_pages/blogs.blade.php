
@extends('layouts.app')

@section('content')

@section('breadcrumb')
	
	<span class="breadcrumb-item active">News</span>	
@endsection

	<!-- Main content -->
	<div class="content-wrapper">

		<!-- Content area -->
		<div class="content">

			<!-- Main charts -->
			<div class="row ">
					<div class="col-xl-12">

						<!-- Traffic sources -->
						<div class="card">
							<div class="card-body">
								<a href="{{url('news/create')}}" class="btn bg-blue">Add Project</a>
								<div class="list-icons float-right mt-1">
										<a class="list-icons-item" onclick="loadTable()" data-action="reload"></a>
									</div>
							</div>
						</div>
						<!-- /traffic sources -->
					</div>
				</div>
				<!-- /main charts -->

			<div class="card pt-2">

				<table class="table datatable-scroll-y" width="100%" id="myTable">
					<thead class="bg-blue">
						<tr>
							<th>Id</th>
							<th>Title</th>
							<th>Subtitle</th>
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


			<!-- /dashboard content -->

		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

	<!-- .modal -->
	<div id="modal-confirm-deletion"  class="modal modal-danger fade animate" data-backdrop="true" style="display: none;" aria-hidden="true">
		<div class="modal-dialog zoom" id="animate" ui-class="zoom">
			<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete News</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete news information</p>
			</div>
			
			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn danger btn-delete-project-confirm p-x-md" data-dismiss="modal">Continue</button>
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
	var projectId = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		let table = $('#myTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! url('newsTableData') !!}',
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'title', name: 'title' },
				{ data: 'sub_title', name: 'sub_title' },
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
	
    function deleteProject(id){
		event.preventDefault();
        projectId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-project-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('news')}}/"+projectId; 
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