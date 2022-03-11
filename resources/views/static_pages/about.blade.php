@extends('layouts.public_app')

@section('content')

<!-- Page content -->
<div class="page-content">
	<!-- Main content -->
	<div class="content">
		<div class="card mt-3">
			<div class="card-body">
			
			<h3 class='mt-1'>About us</h3>
				The Ministry of Water, Irrigation and Energy of Ethiopia is a federal organization established to undertake the management of water resources, water supply and sanitation, large and medium scale irrigation and Energy. The Ministry is a regulatory body which involves the planning, development and management of resources, preparation and implementation of guidelines, strategies, polices, programs, and sectoral laws and regulations. It also, conducts study and research activities, provides technical support to regional water and energy bureaus and especial support to four emerging regions (Gambella, Benishangul-Gumuth, Afar and Somali). In the case of transboundary water resources and regional developments pertinent to the sector, it engages in the negotiation and the signing of international agreements 
				<br>
				<h3 class="mt-1">Vision</h3>
				Ethiopia will be a model of excellence in water resources development utilization and renewable energy
				hub in East Africa by 2015.

				<h3 class='mt-1'>Mission</h3>
				Play a significant role in the socio-economic development of Ethiopia through development and management
				of its water and energy resources in a sustainable manner, through provision of quality and equitable
				supplies in the entire country and by contributing significantly to the food security and foreign
				currency earning.
			</div>
			<h6 class="font-weight-semibold">Available directorates</h6>

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