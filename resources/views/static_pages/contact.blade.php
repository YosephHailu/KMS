@extends('layouts.public_app')

@section('content')

<!-- Page content -->
<div class="page-content">
	<!-- Main content -->
	<div class="content mt-3 row">
			<h3 class="col-12">Contact</h3>

		@foreach ($contacts as $contact)
		<div class="col-md-6">

				<!-- Blog layout #1 with video -->
				<div class="card">
					<div class="card-header bg-random">
						<h5 class="card-title font-weight-semibold"><a href="#" class="text-default">{{$contact->office}}</a></h5>
					</div>

					<div class="card-body">
						{{$contact->remark}}
					</div>

					<div class="card-footer bg-transparent d-sm-flex justify-content-sm-between align-items-sm-center border-top-0 pt-0 pb-3">
						<ul class="list-inline list-inline-dotted text-muted mb-3 mb-sm-0">
							<li class="list-inline-item text-primary">Manager <a href="#" class="text-muted">{{$contact->manager}}</a></li>
							<li class="list-inline-item text-primary">Fax <a href="#" class="text-muted">{{$contact->fax}}</a></li>
							<li class="list-inline-item text-primary">Phone <a href="#" class="text-muted">{{$contact->phone}}</a></li>
						</ul>

					</div>
				</div>
				<!-- /blog layout #1 with video -->

			</div>
		@endforeach
	</div>
</div>
@endsection

@section('script')

@endsection