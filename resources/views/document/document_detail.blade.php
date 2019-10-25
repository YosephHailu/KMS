
@extends('layouts.app')

@section('content')

@section('breadcrumb')
	
	<a href="{{url('document')}}" class="breadcrumb-item"> Document</a>
	<span class="breadcrumb-item active">{{$knowledge->title}}</span>	
@endsection

	<!-- Main content -->
	<div class="content-wrapper">

		<!-- Content area -->
		<div class="content">
			<div class="row">
					<div class="col-md-8">
							<div class="card card-body">
							<div class="media">
								<div class="media-body">
									<h6 class="media-title font-weight-semibold">
										<a href="#">{{$knowledge->title}}</a>
									</h6>

									<ul class="list-inline list-inline-dotted  mb-2">
										<li class="list-inline-item text-primary">Source : <span class="text-muted">{{$knowledge->source}}</span></li>
										<li class="list-inline-item text-primary">Contact : <span class="text-muted">{{$knowledge->contact}}</span></li>
										<li class="list-inline-item text-primary">Directorate : <span class="text-muted">{{$knowledge->directorate->name}}</span></li>
									</ul>
									{{$knowledge->knowledge_description}}
									{{-- Extended kindness trifling remember he confined outlived if. Assistance sentiments yet unpleasing say. Open they an busy they my such high. An active dinner wishes at unable hardly no talked on. Immediate him her resolving his favourite. Wished denote abroad at branch at. Mind what no by kept. --}}
								</div>

								<div class="ml-3">
									<span class="text-muted">{{\Carbon\Carbon::parse($knowledge->created_at)->format('d, M, Y')}}</span>
								</div>
							</div>
						</div>
						<div class="card">
								<div class="card-header header-elements-inline">
									<h5 class="card-title">Project Information</h5>
									<div class="header-elements">
										<div class="list-icons">
											<a class="list-icons-item" data-action="collapse"></a>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table table-bordered">
										<tbody>
											@php $project = $knowledge->project->first(); @endphp
											<tr>
												<td class="text-primary" style="width:30%">Project Status</td>
												<td class="text-muted">{{$project->projectStatus->status}}</td>
											</tr>
											<tr>
												<td class="text-primary" style="width:30%">Project Status</td>
												<td class="text-muted">{{$project->projectCategory->category}}</td>
											</tr>
											<tr>
												<td class="text-primary">Starting And End Date</td>
												<td class="text-muted">{{\Carbon\Carbon::parse($project->starting_date)->format('d, M, Y')}} --/-- 
														{{\Carbon\Carbon::parse($project->end_date)->format('d, M, Y')}}</td>
											</tr>
											<tr>
												<td class="text-primary">Contract Number</td>
												<td class="text-muted">{{$project->contract_no}}</td>
											</tr>
											<tr>
												<td class="text-primary">Project Manager</td>
												<td class="text-muted">{{$project->manager}}</td>
											</tr>											<tr>
												<td class="text-primary">Finance Source</td>
												<td class="text-muted">{{$project->finance->donner_name}}</td>
											</tr>
											<tr>
												<td class="text-primary">Budget</td>
												<td class="text-muted">{{number_format($project->budget)}}</td>
											</tr>
											<tr>
												<td class="text-primary">Project Description</td>
												<td class="text-muted">{{$project->project_description}}</td>
											</tr>
											<tr>
												<td class="text-primary">Outcome</td>
												<td class="text-muted">{{$project->outcome}}</td>
											</tr>
											
											<tr>
												<td class="text-primary">Beneficiary Regions</td>
												<td class="text-muted">
													<div class=" form-group-feedback form-group-feedback-left">
															{{Form::text('keywords', $project->beneficiaries_region,
																['class'=>'tokenfield form-control','data-fouc', 'disabled'])}}
														</div></td>
											</tr>
											
											<tr>
												<td class="text-primary">Beneficiary Weredas</td>
												<td class="text-muted">
													<div class=" form-group-feedback form-group-feedback-left">
															{{Form::text('keywords', $project->wereda_kebele,
																['class'=>'tokenfield form-control','data-fouc', 'disabled'])}}
														</div></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
					</div>
					<div class="col-md-4">
						
						<div class="card card-body p-2 bg-blue m-0">
							<div class="media">
								<div class="media-body">
									<h6 class="media-title font-weight-semibold">Documents</h6>
								</div>
							</div>
						</div>
						<div class="card card-body">
							<div class="media">
								<div class="media-body">
									<h6 class="media-title font-weight-semibold">Mortgage and private loan</h6>
									<span class="text-muted">45 <span class="text-purple-300" > : Downloads</span> </span>
								</div>

								<div class="ml-3 align-self-center">
									<a href=""><i class="icon-download text-purple-300"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!-- /dashboard content -->

		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->
@endsection

@section('script')       
    <script src="{{ asset('global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>          
    <script src="{{ asset('global_assets/js/demo_pages/form_tags_input.js')}}"></script>  
@endsection