@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">Finance Sources</span>
@endsection

<!-- Content area -->
<div class="content">
	<!-- Page Buttons -->
	<div class="card p-2">
		<div class="row">
			<div class="col-sm-4">
				<a href="{{url('finance/create')}}" class="btn bg-blue">Add Finance</a>
			</div>
		</div>
	</div>
	<!-- /Page Buttons -->

	<div class="row">
		@foreach ($finances as $finance)
		<div class="pb-2 col-lg-6 col-md-12">
			<div class="card">
				<div class="card-body mb-0">
					<h4 class="card-title">{{$finance->donner_name}}</h4>
					<p><span class="text-muted">Contact : </span>{{$finance->contact}}</p>
					<p class="card-text"><span class="text-muted">Address : </span>{{$finance->address}}</p>
					<p class="card-text"><span class="text-muted">Credit : </span>{{$finance->credit}}</p>
				</div>

				<div class="card-footer bg-blue">
					<span class=" text-center mt-2 mr-3"><i class="icon-address-book"></i> {{$finance->contact}}</span>
					<span class="ml-3 float-right">
						<a href="{{url('finance/'.$finance->id.'/edit')}}" class="btn btn-primary"> <i
								class="icon-pen6"></i></a>
						<a href="#" class="btn btn-danger btn-delete-finance" id="{{$finance->id}}"> <i
								class="icon-trash	"></i></a>
					</span>
				</div>
			</div>
		</div>
		@endforeach
	</div>

</div>
<!-- /content area -->

<!-- .modal -->
<div id="modal-confirm-deletion" class="modal fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete Finance Information</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-finance-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

@endsection

@section('script')

<script>
	var financeId = 0;
	var token = '{{Session::token()}}';

    $('.btn-delete-finance').on('click', function(event){
        event.preventDefault();
        financeId = this.id;
        $('#modal-confirm-deletion').modal();
    });
    $('.btn-delete-finance-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('finance')}}/"+financeId; 
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