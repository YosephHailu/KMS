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
	<div class="row px-2">
		@foreach ($blogs as $blog)
		<!-- Blog layout #3 with image -->
		<div class="card col-lg-6">
			<div class="card-body">
				<div class="card-img-actions mr-3">
					<img class="card-img img-fluid" style="max-height: 300px;"
						src="{{asset('storage/blog_photos/'.$blog->photo)}}" alt="">
					<div class="card-img-actions-overlay card-img">
						<a href="{{url('news/'.$blog->id)}}"
							class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
							<i class="icon-link"></i>
						</a>
					</div>
				</div>

				<div class="mb-3">
					<h3 class="font-weight-semibold my-1">
						<a href="#" class="text-default">{{$blog->title}}</a>
					</h3>
					<ul class="list-inline list-inline-dotted text-muted mb-0">
						<li class="list-inline-item"> <a href="#" class="text-muted">{{$blog->sub_title}}</a></li>
						<li class="list-inline-item">{{\Carbon\Carbon::parse($blog->created_at)->format('d, M, Y')}}
						</li>
						<li class="list-inline-item"><a href="#" class="text-muted"><i
									class="icon-eye font-size-base text-pink mr-2"></i>
								{{number_format($blog->views)}} </a>
						</li>
						<li class="list-inline-item float-right">
							<a href="#" class="text-muted" onclick="deleteBlog({{$blog->id}})"> <i
									class="icon-trash text-small text-danger"></i></a></li>

						<li class="list-inline-item float-right mr-3">
							<a href="{{'news/'.$blog->id.'/edit'}}" class="text-muted"> <i
									class="icon-pen6 text-small text-primary"></i></a></li>

					</ul>
				</div>

				<p>{{str_limit($blog->message, 300, '') }} <a href="{{url('news/'.$blog->id)}}">[...]</a>
			</div>
		</div>
		<!-- /blog layout #3 with image -->
		@endforeach
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
				<p>Press Continue To Delete News</p>
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