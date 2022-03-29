@extends('layouts.app')

@section('content')

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">
		<!-- Quick stats boxes -->
		@if(Auth::user()->hasAnyPermission('all'))
		<div class="row">
			<div class="col-lg-4 col-md-6">

				<!-- Members online -->
				<div class="card bg-success">
					<div class="card-body">
						<div class="d-flex">
							<h3 class="font-weight-semibold mb-0">{{number_format(App\User::All()->count())}}</h3>
						</div>

						<div>
							{{__('app.dashboard_users')}}
							<div class="font-size-sm opacity-75">
								{{number_format(App\User::where('user_status_id', App\UserStatus::firstOrCreate(['status'=>'Active'])->id)->count())}}
								{{__('app.dashboard_active_users')}}</div>
						</div>
					</div>
				</div>
				<!-- /members online -->

			</div>

			<div class="col-lg-4 col-md-6">

				<!-- Current server load -->
				<div class="card bg-orange-300">
					<div class="card-body">
						<div class="d-flex">
							<h3 class="font-weight-semibold mb-0">
								{{number_format(App\KnowledgeProduct::All()->count())}}</h3>

						</div>

						<div>
							{{__('app.dashboard_total_knowledge_product')}}
							<div class="font-size-sm opacity-75">This Year :
								{{number_format(App\KnowledgeProduct::All()->count())}}</div>
						</div>
					</div>

				</div>
				<!-- /current server load -->

			</div>

			<div class="col-lg-4 col-md-6">

				<!-- Today's revenue -->
				<div class="card bg-danger">
					<div class="card-body">
						<div class="d-flex">
							<h3 class="font-weight-semibold mb-0">{{number_format(App\Attachment::All()->count())}}
							</h3>
						</div>

						<div>
							{{__('app.dashboard_total_attachments')}}
							<div class="font-size-sm opacity-75"></div>
						</div>
					</div>
				</div>
				<!-- /today's revenue -->

			</div>
		</div>
		@endif
		<!-- /quick stats boxes -->


		@if(Auth::user()->hasAnyPermission('manage directorate'))
		<div class="row">
			<div class="col-lg-4 col-md-6">

				<!-- Members online -->
				<div class="card bg-success">
					<div class="card-body">
						<div class="d-flex">
							<h3 class="font-weight-semibold mb-0">
								{{number_format(Auth::user()->directorate->user->count())}}</h3>
						</div>

						<div>
							{{__('app.nav_directorate_users')}}
							<div class="font-size-sm opacity-75">
								{{number_format(Auth::user()->directorate->user->where('user_status_id', App\UserStatus::firstOrCreate(['status'=>'Active'])->id)->count())}}
								{{__('app.dashboard_active_users')}}</div>
						</div>
					</div>

					<div class="container-fluid">
						<div id="members-online"></div>
					</div>
				</div>
				<!-- /members online -->

			</div>

			<div class="col-lg-4 col-md-6">

				<!-- Current server load -->
				<div class="card bg-orange-300">
					<div class="card-body">
						<div class="d-flex">
							<h3 class="font-weight-semibold mb-0">
								{{number_format(Auth::user()->directorate->knowledgeProduct->count())}}</h3>
						</div>

						<div>
							{{__('app.dashboard_total_knowledge_product')}}
							<div class="font-size-sm opacity-75">This Year :
								{{number_format(Auth::user()->directorate->knowledgeProduct->count())}}</div>
						</div>
					</div>

					<div id="server-load"></div>
				</div>
				<!-- /current server load -->

			</div>

			<div class="col-lg-4 col-md-6">

				<!-- Today's revenue -->
				<div class="card bg-danger">
					<div class="card-body">
						<div class="d-flex">
							<h3 class="font-weight-semibold mb-0">{{number_format(App\Attachment::All()->count())}}
							</h3>
						</div>

						<div>
							{{__('app.dashboard_total_attachments')}}
							<div class="font-size-sm opacity-75"></div>
						</div>
					</div>
				</div>
				<!-- /today's revenue -->

			</div>
		</div>
		@endif
		<!-- /quick stats boxes -->

		<!-- Dashboard content -->
		<div class="row">
			@if(Auth::user()->hasAnyPermission('all'))
			<div class="col-xl-8">

				<!-- Knowledge Product Audit -->
				<div class="card">
					<div class="card-header header-elements-sm-inline">
						<h6 class="card-title">{{__('app.dashboard_knowledge_product_audit')}}</h6>
					</div>

					<div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
						<div class="d-flex align-items-center mb-3 mb-sm-0">
							<div id="campaigns-donut"></div>
							<div class="ml-3">
								<h5 class="font-weight-semibold mb-0">{{sizeof($knowledge)}}</h5>
								<span class="badge badge-mark border-success mr-1"></span> <span
									class="text-muted">{{__('app.dashboard_total_knowledge_product')}}</span>
							</div>
						</div>
						<div class="d-flex align-items-center mb-3 mb-sm-0">
							<div id="campaigns-donut"></div>
							<div class="ml-3">
								<h5 class="font-weight-semibold mb-0">{{number_format(App\Directorate::All()->count())}}
								</h5>
								<span class="badge badge-mark border-success mr-1"></span> <span
									class="text-muted">{{__('app.dashboard_total_directorate')}}</span>
							</div>
						</div>

						<div>
							<a href="{{url('audit')}}" class="btn bg-indigo-300"><i class="icon-statistics mr-2"></i>
								{{__('app.dashboard_full_audit')}}</a>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table text-nowrap">
							<thead>
								<tr>
									<th>{{__('app.dashboard_knowledge_category')}}</th>
									<th>{{__('app.dashboard_knowledge_product')}}</th>
									<th>{{__('app.dashboard_percentage')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach (App\KnowledgeProduct::all() as $category)
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div>
												<span
													class="text-default font-weight-semibold">{{$category->category}}</span>
											</div>
										</div>
									</td>
									<td><span class="text-muted"><i
												class="icon-book mr-2"></i>{{$category->knowledgeProduct ? $category->knowledgeProduct->count() : 0}}</span>
									</td>
									<td>
									</td>
								</tr>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
				<!-- /Knowledge Product Audit -->

				<!-- Latest documents -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h6 class="card-title">{{__('app.dashboard_latest_news')}}</h6>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>

					<div class="card-body pb-0">
						<div class="row">
							<div class="p-2">
								@foreach (App\Blog::take(5)->get() as $blog)
								<div class="media flex-column flex-sm-row mt-0  mb-3">

									<div class="media-body">
										<h6 class="media-title"><a
												href="{{url('knowledge/'.$blog->id)}}">{{$blog->title}}</a></h6>
										<ul class="list-inline list-inline-dotted text-muted mb-2">
											<li class="list-inline-item"><i class="icon-arrow-right5 mr-2"></i>
												{{__('app.by')}} : {{$blog->user->name}}</li>
										</ul>
										{{str_limit($blog->message, 300, '...')}}
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<!-- /latest documents -->

			</div>
			@endif

			@if(Auth::user()->hasAnyPermission('manage directorate'))
			<div class="col-xl-8">
				<!-- Knowledge Product Audit -->
				<div class="card">
					<div class="card-header header-elements-sm-inline">
						<h6 class="card-title">{{__('app.dashboard_knowledge_product_audit')}}</h6>
					</div>

					<div class="card-body d-sm-flex align-items-sm-center justify-content-sm-between flex-sm-wrap">
						<div class="d-flex align-items-center mb-3 mb-sm-0">
							<div id="campaigns-donut"></div>
							<div class="ml-3">
								<h5 class="font-weight-semibold mb-0">{{sizeof($knowledge)}}</h5>
								<span class="badge badge-mark border-success mr-1"></span> <span
									class="text-muted">{{__('app.dashboard_total_knowledge_product')}}</span>
							</div>
						</div>
						<div class="d-flex align-items-center mb-3 mb-sm-0">
							<div id="campaigns-donut"></div>
							<div class="ml-3">
								<h5 class="font-weight-semibold mb-0">
									{{Auth::user()->directorate->name}}
								</h5>
								<span class="badge badge-mark border-success mr-1"></span> <span
									class="text-muted">{{__('app.nav_directorate')}}</span>
							</div>
						</div>
						{{-- 
							<div>
								<a href="{{url('audit')}}" class="btn bg-indigo-300"><i class="icon-statistics mr-2"></i>
						{{__('app.dashboard_full_audit')}}</a>
					</div> --}}
				</div>

				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead>
							<tr>
								<th>{{__('app.dashboard_knowledge_category')}}</th>
								<th>{{__('app.dashboard_knowledge_product')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach (App\KnowledgeCategory::All() as $category)
							<tr>
								<td>
									<div class="d-flex align-items-center">
										<div>
											<a href="#"
												class="text-default font-weight-semibold">{{$category->category}}</a>
										</div>
									</div>
								</td>
								<td><span class="text-muted"><i
											class="icon-book mr-2"></i>{{$knowledge->where('knowledge_category_id', $category->id)->count()}}</span>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
			<!-- /Knowledge Product Audit -->

			<!-- Latest News -->
			<div class="card">
				<div class="card-header header-elements-inline">
					<h6 class="card-title">Latest News</h6>
					<div class="header-elements">
						<div class="list-icons">
							<a class="list-icons-item" data-action="collapse"></a>
						</div>
					</div>
				</div>

				<div class="card-body pb-0">
					<div class="row">
						<div class="p-2">
							@foreach (App\Blog::take(5)->get() as $blog)
							<div class="media flex-column flex-sm-row mt-0  mb-3">

								<div class="media-body">
									<h6 class="media-title"><a
											href="{{url('knowledge/'.$blog->id)}}">{{$blog->title}}</a>
									</h6>
									<ul class="list-inline list-inline-dotted text-muted mb-2">
										<li class="list-inline-item"><i class="icon-arrow-right5 mr-2"></i>
											By : {{$blog->user->name}}</li>
									</ul>
									{{str_limit($blog->message, 300, '...')}}
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		<!-- /latest documents -->
		<div class="col-lg-4">
			@if(Auth::user()->hasAnyPermission('all'))
			<div class="card mb-3">
				<div class="card-header header-elements-inline">
					<h6 class="card-title">{{__('app.dashboard_latest_members')}}</h6>
				</div>

				<div class="card-body  text-center">
					@foreach (App\User::All()->take(8) as $user)
					<a href="{{url('users/'.$user->id)}}" class="col-md-6 float-left">
						<img src="{{asset('storage\user_photos\\'.$user->photo)}}" class="rounded-circle" width="60"
							height="60" alt="">
						<p class="font-weight-semibold mt-1"> {{$user->name}}
							<br><span class="text-sm text-muted">{{$user->created_at->format('D-M-Y')}}</span>
						</p>
					</a>
					@endforeach
				</div>
				<a href="{{url('directorateUser')}}" class="text-center p-2">{{__('app.dashboard_show_all')}} →</a>
			</div>
			@endif

			@if(Auth::user()->hasAnyPermission('manage directorate'))
			<div class="card mb-3">
				<div class="card-header header-elements-inline">
					<h6 class="card-title">{{__('app.dashboard_latest_members')}}</h6>
				</div>

				<div class="card-body  text-center">
					@foreach (Auth::user()->directorate->user->take(9) as $user)
					<a href="" class="col-md-6 float-left">
						<img src="{{asset('storage\user_photos\\'.$user->photo)}}" class="rounded-circle" width="60"
							height="60" alt="">
						<p class="font-weight-semibold mt-1"> {{$user->name}}
							<br><span class="text-sm text-muted">{{$user->created_at->format('D-M-Y')}}</span>
						</p>
					</a>
					@endforeach
				</div>
				<a href="{{url('directorateUser')}}" class="text-center p-2">{{__('app.dashboard_show_all')}} →</a>
			</div>
			@endif
			<!-- Latest Documents -->
			<div class="card">
				<div class="card-header header-elements-inline bg-indigo-400">
					<h6 class="card-title">{{__('app.dashboard_latest_documents')}}</h6>
				</div>

				<!-- Latest Documents Report -->

				<div class="tab-content card-body">
					<div class="tab-pane active fade show" id="messages-tue">
						<ul class="media-list">

						</ul>
					</div>
				</div>
				<!-- /Latest documents report -->

			</div>
			<!-- /my messages -->
		</div>

	</div>
	<!-- /dashboard content -->

</div>
<!-- /content area -->

</div>
<!-- /main content -->
@endsection