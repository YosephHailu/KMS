@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">Directorate</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<!-- Buttons -->
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-4">
						<a href="{{url('directorate/create')}}" class="btn bg-blue"> Add Directorate</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /Buttons -->

		<div class="row mb-sm-3 mr-1">
			@foreach ($directorates as $directorate)
			<div class="mb-2 col-lg-6 col-md-12	">
				<div class="card-body card m-0">
					<h4 class="card-title">{{$directorate->name}}</h4>
					<p class="text-muted">{{$directorate->manager}}</p>
					<p class="card-text">{{$directorate->description}}</p>
				</div>

				<div class="card-footer bg-blue d-flex justify-content-between">
					<span class=" text-center mt-1"><i class="icon-address-book"></i> {{$directorate->contact}}</span>
					<span>
						<a href="{{url('directorate/'.$directorate->id.'/edit')}}" class="btn btn-primary"> <i
								class="icon-pen6"></i></a>
						<a href="#" class="btn btn-danger btn-delete-directorate" id="{{$directorate->id}}"> <i
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
				<h5 class="modal-title">Delete Directorate</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete directorate information</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-directorate-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

@endsection

@section('script')

<script>
	var directorateId = 0;
	var token = '{{Session::token()}}';

    $('.btn-delete-directorate').on('click', function(event){
        event.preventDefault();
        directorateId = this.id;
        $('#modal-confirm-deletion').modal();
    });
    $('.btn-delete-directorate-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('directorate')}}/"+directorateId; 
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