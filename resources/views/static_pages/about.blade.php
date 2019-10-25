@extends('layouts.public_app')

@section('content')

<!-- Page content -->
<div class="page-content">
	<!-- Main content -->
	<div class="content">
		<div class="card mt-3">
			<div class="card-body">
				<div class="mt-1 mb-4">
					<h3 class="font-weight-semibold">About The System</h3>
					<p>Knowledge management is the process of creating, sharing, using and managing the knowledge and
						information of an organization. It refers to a multidisciplinary approach to achieving
						organizational objectives by making the best use of knowledge.</p>
					<p>The Knowledge Portal of OWERDB will present updated resources and documentation.
						It provides experts the resources to review policies, guidelines, previous reports and case
						stories from various projects in the organization. They are typically used to showcase the work
						of an organisation and provide signposts to documents, articles and toolkits. The portal is
						updated with the support of the knowledge management unit and by assigned staff from each
						directorate.</p>
					<p>The resources may be produced by the various experts and directorates within OWERDB and at all
						government levels: zones and woredas. Learning and research documents by other WASH stakeholders
						will also be included.</p>
				</div>

				<h3>Each thematic area can be navigated to from the homepage and contains the following information:
				</h3>
				<div class="row">
					<div class="col-sm-6">
						<div class="mb-4">
							<dl>
								<dt class="font-size-sm font-weight-bold text-uppercase p-1">
									<i class="icon-checkmark3 text-blue mr-2"></i>
									Key documents that relate to the area.
								</dt>

								<dt class="font-size-sm font-weight-bold text-uppercase p-1">
									<i class="icon-checkmark3 text-blue mr-2"></i>
									Resources and documents that relate to the theme. These can be further filtered
									based on the theme sub categories, language and document type options.
								</dt>

							</dl>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="mb-4">
							<dl>

								<dt class="font-size-sm font-weight-bold text-uppercase ">
									<i class="icon-checkmark3 text-blue mr-2"></i>
									A brief description of the thematic area
								</dt>
								<dt class="font-size-sm font-weight-bold text-uppercase p-1">
									<i class="icon-checkmark3 text-blue mr-2"></i>
									Key people to contact,
								</dt>

							</dl>
						</div>
					</div>
				</div>
				<h3>Vision</h3>
				Ethiopia will be a model of excellence in water resources development utilization and renewable energy
				hub in East Africa by 2015.

				<h3 class='mt-1'>Mission</h3>
				Play a significant role in the socio-economic development of Ethiopia through development and management
				of its water and energy resources in a sustainable manner, through provision of quality and equitable
				supplies in the entire country and by contributing significantly to the food security and foreign
				currency earning.
				<h6 class="font-weight-semibold">Available directorates</h6>
			</div>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Directorate</th>
							<th>Description</th>
							<th>Manager</th>
							<th>Contact</th>
						</tr>
					</thead>
					<tbody>
						@foreach (App\Directorate::All() as $directorate)
						<tr>
							<td>{{$directorate->name}}</td>
							<td>{{$directorate->description}}
							<td>{{$directorate->manager}}
							<td>{{$directorate->contact}}
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>

	<div class="col-md-4 col-sm-12">

	</div>
</div>
@endsection

@section('script')

@endsection