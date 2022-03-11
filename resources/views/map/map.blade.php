@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">{{__('app.nav_maps')}}</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<div class="card p-2">
			<div class="col-md-4">
				<a href="{{url('map/create')}}" class="btn bg-blue">{{__('knowledge.add_map')}}</a>
			</div>
		</div>

		<div class="card pt-2 table-responsive">

			<table class="table datatable-scroll-y" width="100%" id="myTable">
				<thead class="bg-blue">
					<tr>
						<th>{{__('knowledge.id')}}</th>
						<th style="min-width:200px">{{__('knowledge.title')}}</th>
						<th>{{__('knowledge.directorate')}}</th>
						<th>{{__('knowledge.map_type')}}</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($maps as $map)
					<tr>
						<td>{{$map->id}}</td>
						<td style="min-width:200px">
							<div class="d-flex align-items-center">
								<div>
									<span
										class="text-default font-weight-semibold">{{$map->knowledgeProduct->title}}</span>
									<div class="text-muted font-size-sm">
										<span class="badge badge-mark border-grey-400 mr-1"></span>
										Source - {{$map->knowledgeProduct->source}}

										<span class="badge badge-mark border-pink-400 ml-3"></span>
										Issued Date - {{$map->created_date}}
									</div>
								</div>
							</div>
						</td>
						<td>{{$map->knowledgeProduct->directorate->name}}</td>
						<td>{{$map->mapType->type}}</td>
						<td>
							<a href="{{url('knowledge/'.$map->knowledgeProduct->id)}}">
								<i class="icon-new-tab"></i>
							</a>
						</td>
						@if (Auth::user()->can('update', $map->knowledgeProduct))
						<td>
							<a href="{{url('map/'.$map->id.'/edit')}}">
								<i class="icon-pen6"></i></a>
						</td>
						<td>
							<a href="#" onclick="deleteMap({{$map->id}})" class="text-danger"><i
									class="icon-trash"></i></a>
						</td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /scrollable datatable -->
	</div>
	<!-- /content area -->

</div>
<!-- /main content -->

<!-- .modal -->
<div id="modal-confirm-deletion" class="modal modal-danger fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<!-- modal-content -->
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete Map Information</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete map information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-map-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div>
		<!-- /.modal-content -->
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
	var mapId = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		let table = $('#myTable').DataTable({
			
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
	
    function deleteMap(id){
		event.preventDefault();
        mapId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-map-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('map')}}/"+mapId; 
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