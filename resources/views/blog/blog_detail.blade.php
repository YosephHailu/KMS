
@extends('layouts.public_app')

@section('content')

	<!-- Main content -->
	<div class="page-content">

		<!-- Content area -->
		<div class="content mt-3">
			<div class="row">
				<div class="col-lg-8">
					
					<div class="card blog-horizontal">
						<div class="card-body">
							<div class="card-img-actions mr-3">
								<img class="card-img img-fluid" style="max-height: 300px;" src="{{asset('storage/blog_photos/'.$blog->photo)}}" alt="">
								<div class="card-img-actions-overlay card-img">
									<a href="{{url('news/'.$blog->id)}}" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round">
										<i class="icon-link"></i>
									</a>
								</div>
							</div>
	
							<div class="mb-3">
								<h3 class="font-weight-semibold my-1">
									<a href="#" class="text-default">{{$blog->title}}</a>
								</h3>
								<ul class="list-inline list-inline-dotted text-muted mb-0">
									<li class="list-inline-item"> <a href="#" class="text-muted">{{$blog->sub_title}}</a></li>
									<li class="list-inline-item">{{\Carbon\Carbon::parse($blog->created_at)->format('d, M, Y')}}</li>
									<li class="list-inline-item"><a href="#" class="text-muted"><i class="icon-eye font-size-base text-pink mr-2"></i> {{number_format($blog->views)}}</a></li>
								</ul>
							</div>
	
							<p>{{$blog->message}} <a href="#"></a>
						</div>
					</div>
					
				</div>
				<div class="col-12 col-lg-4">
					<div class="card card-body">
						<h5 class="font-weight-semibold">Latest News</h5>
						@foreach (App\Blog::take(5)->get() as $blog)
							<div class="media p-0 m-0">
								<div class="mr-3">
									<a href="#">
										<img src="../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="44" height="44" alt="">
									</a>
								</div>

								<div class="media-body">
									<h6 class="media-title"><a href="#">{{$blog->title}}</a></h6>
									<p class="p-1 text-muted">{{str_limit($blog->message, 100, '...') }}</p>
								</div>
							</div>
						@endforeach
					</div>
				</div>	
			</div>
			<!-- /dashboard content -->

		</div>
		<!-- /content area -->

	</div>
	<!-- /main content -->

	<!-- .modal -->
@endsection

@section('script')       
    <script src="{{ asset('global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>          
	<script src="{{ asset('global_assets/js/demo_pages/form_tags_input.js')}}"></script>  
@endsection