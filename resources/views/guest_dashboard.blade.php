
@extends('layouts.app')

@section('content')

@section('breadcrumb')
	<span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> Dashboard</span>	
@endsection

	<!-- Main content -->
	<div class="content-wrapper">

		<!-- Content area -->
		<div class="content">
			<div class="card bg-primary card-body">
				<h3 class="text-lg text-center">Welcome {{Auth::user()->name}}</h3>
			</div>
			<!-- Dashboard content -->
			<div class="row">
				<div class="col-xl-8">
					<!-- Latest documents -->
					<div class="card">
						<div class="card-header header-elements-inline">
							<h6 class="card-title">Latest Knowledge Products</h6>
							<div class="header-elements">
								<div class="list-icons">
									<a class="list-icons-item" data-action="collapse"></a>
								</div>
							</div>
						</div>

						<div class="card-body pb-0">
							<div class="row">
								<div class="p-2">
									@foreach ($knowledge->take(5) as $item)
										<div class="media flex-column flex-sm-row mt-0  mb-3">

											<div class="media-body">
												<h6 class="media-title"><a href="{{url('knowledge/'.$item->id)}}">{{$item->title}}</a></h6>
												<ul class="list-inline list-inline-dotted text-muted mb-2">
													<li class="list-inline-item"><i class="icon-arrow-right5 mr-2"></i> {{$item->knowledgeCategory->category}}</li>
												</ul>
												{{str_limit($item->knowledge_description, 300, '...')}}
											</div>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
					<!-- /latest documents -->

				</div>

				<div class="col-xl-4">
					<div class="card mb-3">
						<div class="card-header header-elements-inline">
							<h6 class="card-title">Latest News</h6>
						</div>
						<div class="card-body">
								@foreach (App\Blog::take(5)->get() as $blog)
									<div class="media">		
										<div class="media-body">
											<h6 class="media-title"><a href="#">{{$blog->title}}</a></h6>
											<p class="px-1">{{str_limit($blog->message, 100, '...') }}</p>
										</div>
									</div>
								@endforeach
							</div>
						<a href="{{url('users')}}" class="text-center p-2">Show All →</a>
					</div>
					<!-- Noticeboard -->
					<div class="card">
						<div class="card-header header-elements-inline">
							<h6 class="card-title">Noticeboard</h6>
						</div>

						<!-- Noticeboard Report -->
						<ul class="nav nav-tabs nav-tabs-solid nav-justified bg-indigo-400 border-x-0 border-bottom-0 border-top-indigo-300 mb-0">
							<li class="nav-item">
								<a href="" class="nav-link font-size-sm active">
										<h5 class="font-weight-semibold mb-0">32,693</h5>
										<span class="text-muted font-size-sm">This Month</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="" class="nav-link font-size-sm active">
										<h5 class="font-weight-semibold mb-0">32,693</h5>
										<span class="text-muted font-size-sm">This Year</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="" class="nav-link font-size-sm active">
										<h5 class="font-weight-semibold mb-0">32,693</h5>
										<span class="text-muted font-size-sm">all messages</span>
								</a>
							</li>
						</ul>
						<!-- Dashboard Report content -->

						<div class="tab-content card-body">
							<div class="tab-pane active fade show" id="messages-tue">
								<ul class="media-list">
									@foreach (App\NoticeBoard::take(7)->get() as $noticeBoard)
										<li class="media">	
											<div class="media-body">
												<div class="d-flex justify-content-between">
													<a href="#">{{$noticeBoard->header}}</a>
													<span class="font-size-sm text-muted">{{$noticeBoard->created_at->format('D-M-Y H:I')}}</span>
												</div>
	
												{{str_limit($noticeBoard->message, 70, '...')}}...
											</div>
										</li>	
									@endforeach
								</ul>
							</div>
						</div>
						<!-- /tabs content -->

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