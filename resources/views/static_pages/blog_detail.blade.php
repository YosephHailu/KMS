
@extends('layouts.public_app')

@section('content')

	<!-- Main content -->
	<div class="page-content">

		<!-- Content area -->
		<div class="content">
			<div class="row">
				<div class="col-md-8">
					<div class="card card-body ">
						<div class="media">
							<div class="">
								<h6 class="media-title ">
									<a href="#" class="font-weight-semibold">{{$blog->title}}</a>
									<span class="text-muted float-right ml-3">{{\Carbon\Carbon::parse($blog->created_at)->format('d, M, Y')}}</span>
									
								</h6>
								<a href="#" class="font-weight-semibold text-muted">{{$blog->sub_title}}</a>

								<ul class="list-inline list-inline-dotted text-muted mb-2">									
									<li class="list-inline-item">
										<span class="text-blue">Views :</span>  {{number_format($blog->views)}}</li>
								</ul>
								<img src="{{asset('owme.jpg')}}" class="rounded-circle" width="120" height="120" alt="">
								<p class="font-size-lg">
										{{$blog->message}}
								</p>
							</div>

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