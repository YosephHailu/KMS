@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">Slider</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<div class="card p-2">
			<div class="row">
				<div class="col-sm-4">
					<a href="{{url('slider/create')}}" class="btn bg-blue">Add Slider</a>
				</div>
			</div>
		</div>

		<div class="row">
			@foreach ($sliders as $slider)
			<div class="col-lg-6 col-md-12">
				<div class="card">
					<img class="card-img-top img-fluid"  src="{{asset('storage\slider_photos\\'.$slider->photo)}}"
						style="max-height:200px; object-fit: cover;" alt="">

					<div class="card-body">
						<h5 class="card-title text-center text-blue">{{$slider->title}}</h5>
						<p class="card-text">{{$slider->message}}</p>
					</div>

					<div class="card-footer {{$slider->active?'bg-blue':'bg-danger'}}">
						<span class="float-right">
							<a href="{{url('slider/'.$slider->id.'/edit')}}" class="btn btn-primary"> <i
									class="icon-pen6"></i></a>
							<a href="#" class="btn btn-danger btn-delete-slider" id="{{$slider->id}}"> <i
									class="icon-trash	"></i></a>
						</span>
					</div>
				</div>
			</div>
			@endforeach

		</div>
		<!-- /dashboard content -->
		{{$sliders->links()}}

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
				<h5 class="modal-title">Delete Slider</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete slider Content</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn danger btn-delete-slider-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

@endsection

@section('script')

<script>
	var sliderId = 0;
	var token = '{{Session::token()}}';

    $('.btn-delete-slider').on('click', function(event){
        event.preventDefault();
        sliderId = this.id;
        $('#modal-confirm-deletion').modal();
    });
    $('.btn-delete-slider-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('slider')}}/"+sliderId; 
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