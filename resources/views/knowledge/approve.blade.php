@extends('layouts.app')

@section('content')

@section('breadcrumb')
<span class="breadcrumb-item active">Document</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">
		<div class="card">
			<table class="table datatable-scroll-y " width="100%" id="myTable">
				<thead class="bg-blue col-12">
					<tr>
						<th>{{__('knowledge.id')}}</th>
						<th>{{__('knowledge.title')}}</th>
						<th>{{__('knowledge.access_level')}}</th>
						<th>{{__('knowledge.category')}}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($knowledges as $knowledge)
					<tr>
						<td>{{$knowledge->id}}</td>
						<td>
							<div class="d-flex align-items-center">
								<div>
									<span class="text-default font-weight-semibold">
										<a
											href="{{url('search/detail/'.$knowledge->id)}}">{{$knowledge->title}}</a></span>
									<div class="text-muted font-size-sm">
										<span class="badge badge-mark border-grey-400 mr-1"></span>
										{{__('knowledge.source')}} - {{$knowledge->source}}

										<span class="badge badge-mark border-pink-400 ml-3"></span>
										{{__('app.dashboard_by')}} - 
										<a href="{{url('users/'.$knowledge->user_id)}}">
											{{$knowledge->user->name}}
										</a>
									</div>
								</div>
							</div>
						</td>
						<td>{{$knowledge->accessLevel->level}}</td>
						<td>{{$knowledge->knowledgeCategory->category}}</td>
						<td>
							<a href="{{url('updateStatus/'.$knowledge->id)}}" class="btn btn-success"> Publish </a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /scrollable datatable -->


		<!-- /dashboard content -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->

@endsection

@section('script')
<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
<script src="{{ asset('global_assets/js/demo_pages/datatables_responsive.js')}}"></script>

<script>
	var knowledgeId = 0;
	var token = '{{Session::token()}}';

	$(document).ready( function () {
		let table = $('#myTable').DataTable();
				
        // Initialize
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
	});
	
    function deleteKnowledgeProduct(id){
		event.preventDefault();
        knowledgeId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-knowledgeProduct-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('knowledge')}}/"+knowledgeId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
            // console.log(msg);
            location.reload();
        }).fail(function(msg){
            // console.log(msg);
        });
    });
</script>
@endsection