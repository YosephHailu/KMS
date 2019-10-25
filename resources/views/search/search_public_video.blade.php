@extends('layouts.public_app')

@section('content')

	<!-- Side Bar -->

	{{-- @include('layouts.public_sidebar')         --}}
	<!-- /Side Bar -->

	<!-- Main content -->
	<div class="content">
			@include('search.search_nav')
			<!-- Search results -->
			<div class="row">
				<div class="col-12 col-lg-8">
					<div class="card card-body">
						<span class="text-muted font-size-sm">{{__('search.about')}} {{number_format($knowledge->count())}} {{__('search.result')}}</span>

						<hr>

						<ul class="media-list mb-3">
							@foreach ($knowledge as $item)
								<li class="media">
									<div class="mr-sm-3 mb-2 mb-sm-0">
										<div class="card-img-actions">
											<a href="{{url('search/detail/'.$item->id)}}">
												@if($item->attachments->first() != null)
												<video preload="metadata" class="img-fluid img-preview rounded"  controls='true'>
													<source  src="{{url('getAttachment/'.$item->attachments->first()->id)}}"/>
												</video>
												<span class="card-img-actions-overlay card-img"><i class="icon-play3"></i></span>
												@endif
											</a>
										</div>
									</div>
	
									<div class="media-body">
										<h6 class="media-title"><a href="{{url('search/detail/'.$item->id)}}">{{$item->title}}</a></h6>
										<ul class="list-inline list-inline-dotted text-muted mb-2">
											<li class="list-inline-item"><a href="#" class="text-success">{{$item->knowledgeCategory->category}}</a></li>
											<li class="list-inline-item">
												<i class="icon-star-full2 font-size-base text-warning-300"></i>
												<i class="{{$item->knowledgeRating->avg('rating') >= 2?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
												<i class="{{$item->knowledgeRating->avg('rating') >= 3?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
												<i class="{{$item->knowledgeRating->avg('rating') >= 4?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
												<i class="{{$item->knowledgeRating->avg('rating') >= 5?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
												&nbsp; {{$item->knowledgeRating->count()}} Rattings
											</li>
											<li class="list-inline-item">{{number_format($item->views)}} Views</li>
										</ul>
										<p>{{str_limit($item->knowledge_description, 300, '...') }}</p>
									</div>
								</li>
							@endforeach

							
							<li class="media">
								<div class="card-body border-top border-bottom">
									<h6 class="mb-1">{{__('search.latest document')}}</h6>
									<div class="list-unstyled row">
										@foreach(App\KnowledgeProduct::take(6)->get() as $item)
											<div class="m-2"><a href="#">{{$item->title}}</div>
										@endforeach
									</div>
								</div>
							</li>
						</ul>

						<ul class="pagination pagination-flat align-self-center flex-wrap my-2">
								{{ $knowledge->appends(array_merge(request()->except('page'), ['q'=> request()->q == null?'':request()->q]))->links() }}</ul>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card card-body">
						<h5 class="font-weight-semibold">{{__('search.latest news')}}</h5>
						@foreach (App\Blog::take(5)->get() as $blog)
							<div class="media p-0 m-0">
								<div class="mr-3">
									<a href="#">
										<img src="../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" width="44" height="44" alt="">
									</a>
								</div>

								<div class="media-body">
									<h6 class="media-title"><a href="{{url('news/'.$blog->id)}}">{{$blog->title}}</a></h6>
									<p class="p-1 text-muted">{{str_limit($blog->message, 100, '...') }}</p>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<!-- /search results -->

		</div>
	<!-- /main content -->
@endsection