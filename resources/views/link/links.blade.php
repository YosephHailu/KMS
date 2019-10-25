@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">Important Links</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">
		<div class="card p-2">
			<div class="row">
				<div class="col-sm-4">
					<a href="{{url('link/create')}}" class="btn bg-blue">Add link</a>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach ($links as $link)
			<div class="mb-2 col-lg-6 col-md-12">
				<div class="card-body mb-0 card">
					<h4 class="card-title">{{$link->name}}</h4>
					<p class="text-muted">Link : {{$link->link}}</p>
				</div>

				<div class="card-footer bg-blue text-right">
					{{-- <span class=" text-center mt-1"><i class="icon-calendar mr-1"></i> {{\Carbon\Carbon::parse($link->created_at)->format('d, M, Y')}}</span>
					--}}
					<span>
						<a href="{{url('link/'.$link->id.'/edit')}}" class="btn btn-primary"> <i
								class="icon-pen6"></i></a>
						<a href="#" class="btn btn-danger btn-delete-link" id="{{$link->id}}"> <i
								class="icon-trash	"></i></a>
					</span>
				</div>
			</div>
			@endforeach
		</div>
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
				<h5 class="modal-title">Delete link Information</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-link-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

@endsection

@section('script')

<script>
	var linkId = 0;
	var token = '{{Session::token()}}';

    $('.btn-delete-link').on('click', function(event){
        event.preventDefault();
        linkId = this.id;
        $('#modal-confirm-deletion').modal();
    });
    $('.btn-delete-link-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('link')}}/"+linkId; 
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