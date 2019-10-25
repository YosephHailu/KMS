@extends('layouts.public_app')

@section('content')

<!-- Page content -->
<div class="page-content">
	<!-- Main content -->
	<div class="content">
		<div class="card mt-3">
			<div class="card-header">
				<h3>Contact</h3>
			</div>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Office Name</th>
							<th>Manager</th>
							<th>Phone</th>
							<th>Fax</th>
							<th>remark</th>
						</tr>
					</thead>
					<tbody>
						@foreach (App\Contact::All() as $contact)
						<tr>
							<td>{{$contact->office}}</td>
							<td>{{$contact->manager}}
							<td>{{$contact->phone}}
							<td>{{$contact->fax}}
							<td>{{$contact->remark}}
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')

@endsection