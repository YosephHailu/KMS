@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">{{__('app.nav_photos')}}</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<!-- Add btn -->
		@can('create', App\KnowledgeProduct::class)
		<div class="card p-2">
			<div class="col-md-4">
				<a href="{{url('photo/create')}}" class="btn bg-blue">{{__('knowledge.add_photo')}}</a>
			</div>
		</div>
		@endif

		<div class="card pt-2 table table-responsive white">

			<table class="table datatable-scroll-y" width="100%" id="myTable">
				<thead class="bg-blue">
					<tr>
						<th>{{__('knowledge.id')}}</th>
						<th>{{__('knowledge.title')}}</th>
						<th>{{__('knowledge.directorate')}}</th>
						<th>{{__('knowledge.source')}}</th>
						<th>{{__('knowledge.created_date')}}</th>
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
<div id="modal-confirm-deletion" class="modal modal-danger fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete Knowledge Product Information</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to photo gallery information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn danger btn-delete-photoProduct-confirm p-x-md"
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
	var photoId = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		let table = $('#myTable').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! url('photoTableData') !!}',
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'title', name: 'title' },
				{ data: 'directorate', name: 'directorate' },
				{ data: 'source', name: 'source' },
				{ data: 'event_date', name: 'event_date' },
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
	
    function deletePhoto(id){
		event.preventDefault();
        photoId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-photoProduct-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('photo')}}/"+photoId; 
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