
@php 
$company = App\Company::first();
@endphp

@extends('layouts.app')

@section('content')

@section('breadcrumb')
	
	<span class="breadcrumb-item active">Knowledge Audit</span>	
@endsection

	<!-- Main content -->
	<div class="content-wrapper">

		<!-- Content area -->
		<div class="content">
				<div class="card">
					<div class="card-header header-elements-inline">
						<img src="{{asset('storage\company\\'.($company != null ? $company->logo : "nofile.jpg"))}}" class="flo" height="75px" width="75px" alt="">
						<h5 class="card-title ml-2">{{$company != null ? $company->name : "Organization Name"}}</h5>
						<div class="header-elements">
							<div class="list-icons">
								<p class="pull-right text-muted"><strong>Date :</strong> {{\Carbon\Carbon::Now()->format('D-M-Y h:m:i')}}</p>								
		                	</div>
	                	</div>
					</div>
					<hr>
					<div class="card-body inline">
							<div class="col-sm-4 float-left">
									<h5><b>Knowledge Products</b></h5>
									<address>
											Total Product: {{App\knowledgeProduct::count()}}<br>
									</address>
								  </div>
								  <!-- /.col -->
								   <div class="col-sm-4 float-left">
									<h5><b>Projects</b></h5>
									<address>
											Total Project: {{App\Project::count()}}<br>
									</address>
								  </div>
								  <!-- /.col -->
								  <div class="col-sm-4 float-left">
									<h5><b>Statistics</b></h5>
									<address>
											Total Views: {{number_format(App\knowledgeProduct::all()->sum('views'))}}<br>
											Total Contributor: {{App\User::All()->filter(function($user){
												return $user->hasPermissionTo('manage knowledge');
											})->count()}}<br>
										Total Downloads: {{
											number_format(App\Attachment::all()->sum('downloads'))
										}}<br>
								  </address></div>
						{{-- Example of <code>large</code> table sizing using <code>.table-lg</code> class added to the <code>.table</code>. All table rows have <code>53px</code> height in REM units. --}}
					</div>

					<div class="table-responsive">
						<table class="table table-lg">
							<thead class="bg-blue">
								<tr>
									<th>#</th>
									<th>Directorate Name</th>
									<th>Manager</th>
									<th>Project</th>
									<th>Total Knowledge Product</th>
									<th>Staff</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($directorates as $directorate)
									<tr>
										<td>#DIR-{{$directorate->id}}</td>
										<td>{{$directorate->name}}</td>
										<td>{{$directorate->manager}}</td>
										<td>{{$directorate->project->count()}}</td>
										<td>{{$directorate->knowledgeProduct->count()}}</td>
										<td>{{$directorate->user->count()}}</td>
									</tr>	
								@endforeach
								
							</tbody>
						</table>
					</div>
					<div class="row m-2">
							<div class="col-sm-4 mt-3 float-right text-center">
								<img src="{{asset('storage\company\\'.($company != null ? $company->logo : "nofile.jpg"))}}" style="height: 150px;" alt="">
							</div>
							<!-- /.col -->
							<div class="col-sm-8 float-left">
					
							  <div class="table-responsive">
								<table class="table table-bordered table-lg">
								  <tbody>
									  <tr class="bg-blue">
											<th colspan="3">Knowledge Product Audit</th>
										</tr>
									<tr>
									<th style="width:50%">Directorates:</th>
									<td>{{App\Directorate::All()->count()}}</td>
								  </tr>
								  <tr>
									<th>Projects</th>
									<td>{{App\Project::count()}}</td>
								  </tr>
								  <tr>
									<th>Other Knowledge Products</th>
									<td>{{App\knowledgeProduct::count() - App\Project::count()}}</td>
								  </tr>
								  <tr>
									<th>Total Knowledge Products:</th>
									<td>{{App\knowledgeProduct::count()}}</td>
								  </tr>
								</tbody></table>
							  </div>
							</div>
							<!-- /.col -->
						  </div>
				</div>
		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

@endsection

@section('script')
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>     
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>     
	<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>     
	<script src="{{ asset('global_assets/js/demo_pages/datatables_responsive.js')}}"></script> 

@endsection