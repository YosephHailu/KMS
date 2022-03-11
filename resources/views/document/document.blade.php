@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">{{__('app.nav_documents')}}</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<!-- Page Buttons -->
		<div class="card p-2">

			<div class="row">
				<div class="col-sm-4">
					<a href="{{url('document/create')}}" class="btn bg-blue">{{__('knowledge.add_document')}}</a>
				</div>
			</div>
		</div>

		<div class="card pt-2">

			<table class="table datatable-scroll-y" width="100%" id="myTable">
				<thead class="bg-blue">
					<tr>
						<th>{{__('knowledge.id')}}</th>
						<th>{{__('knowledge.title')}}</th>
						<th>{{__('knowledge.directorate')}}</th>
						<th>{{__('knowledge.category')}}</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($documents as $document)
					<tr>
						<td>{{$document->id}}</td>
						<td>
							<div class="d-flex align-items-center">
								<div>
									<span
										class="text-default font-weight-semibold">{{$document->knowledgeProduct->title}}</span>
									<div class="text-muted font-size-sm">
										<span class="badge badge-mark border-grey-400 mr-1"></span>
										{{__('knowledge.source')}} - {{$document->knowledgeProduct->source}}

										<span class="badge badge-mark border-pink-400 ml-3"></span>
										{{__('knowledge.issued_date')}} - {{$document->issued_date}}
									</div>
								</div>
							</div>
						</td>
						<td>{{$document->knowledgeProduct->directorate->name}}</td>
						<td>{{$document->documentCategory->category}}</td>
						<td>
							<a href="{{url('knowledge/'.$document->knowledgeProduct->id)}}"><i class="icon-new-tab"></i>
							</a>
						</td>
						@if(Auth::user()->can('update', $document->knowledgeProduct))

						<td>
							<a href="{{url('document/'.$document->id.'/edit')}}">
								<i class="icon-pen6"></i></a>
						</td>
						<td>
							<a href="" onclick="deleteDocument({{$document->id}})" class="text-danger"><i
									class="icon-trash"></i></a>
						</td>
						@else
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
		<tfoot class='text-center p-2'>
			{{$documents->links()}}
		</tfoot>
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
				<h5 class="modal-title">Delete Document</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete document information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn danger btn-delete-document-confirm p-x-md"
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
	var documentId = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		$('#myTable').DataTable({
			paging: false,
			info: false,
		}
		);
		
        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
	});
	
    function deleteDocument(id){
		event.preventDefault();
        documentId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-document-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('document')}}/"+documentId; 
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