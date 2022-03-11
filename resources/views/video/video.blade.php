@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">Videos</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<!-- Add btn -->
		@can('create', App\KnowledgeProduct::class)
		<div class="card p-2">
			<div class="col-md-4">
				<a href="{{url('video/create')}}" class="btn bg-blue">{{__('knowledge.add_video')}}</a>
			</div>
		</div>
		@endcan
		<!-- /Add btn -->

		<!-- Video grid -->
		<div class="row">
			@foreach ($videos as $video)
			<div class="col-sm-6 col-xl-4">
				<div class="card">
					<div class="card-img-actions mx-1 mt-1">
						<div class="card-img embed-responsive embed-responsive-16by9">
							@if($video->knowledgeProduct->attachments->first() != null)
							<video controls=”true”>
								<source
									src="{{url('getAttachment/'.$video->knowledgeProduct->attachments->first()->id)}}" />
							</video>
							@endif
						</div>
					</div>
					<div class="card-body">
						<div class="d-flex align-items-start flex-nowrap">
							<div>
								<h6 class="font-weight-semibold mr-2"><a
										href="{{url('knowledge/'.$video->knowledgeProduct->id)}}">{{$video->knowledgeProduct->title}}</a>
									<small class="badge label-red"> {{$video->knowledgeProduct->attachments->count()}}
											{{__('knowledge.more_attachments')}}</small></h6>
								<span>{{str_limit($video->knowledgeProduct->knowledge_description, 150, "...")}}</span>
							</div>
						</div>
					</div>
					<div class="card-footer">
						{{\Carbon\Carbon::parse($video->created_date)->format('D-M-Y')}}
						<div class="float-right">
							@can('update', $video->knowledgeProduct)
							<a href="{{url('video/'.$video->id.'/edit')}}" class="list-icons-item m-1 text-primary"><i
									class="icon-pen6"></i></a>
							@endcan
							@can('delete', $video->knowledgeProduct)
							<a href="" onclick="deleteVideo({{$video->id}})" id='.$video->id.'
								class="text-danger list-icons-item m-1"><i class="icon-trash"></i></a>
							@endcan()
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>

		<tfoot class='text-center p-2'>
			{{$videos->links()}}
		</tfoot>
		<!-- /video grid -->
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
				<p>Press continue to delete video information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-videoProduct-confirm p-x-md"
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
	var videoId = 0;
	var token = '{{Session::token()}}';

    function deleteVideo(id){
		event.preventDefault();
        videoId = id;
        $('#modal-confirm-deletion').modal();
    }
    
    $('.btn-delete-videoProduct-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('video')}}/"+videoId; 
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