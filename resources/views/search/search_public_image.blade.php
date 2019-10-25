@extends('layouts.public_app')

@section('content')

@include('search.search_nav')
<!-- Search results -->
<div class="row">
	<div class="col-12 col-lg-8">
		<span class="text-muted font-size-sm">About {{number_format($knowledge->count())}} results</span>

		@foreach ($knowledge as $item)
		<div class="card card-body my-3">
			<h6 class="media-title"><a href="{{url('search/detail/'.$item->id)}}">{{$item->title}}</a></h6>

			<ul class="media-list">
				<li class="media">
					<div class="media-body">
						<ul class="list-inline list-inline-dotted text-muted">
							<li class="list-inline-item">Posted as <a href="#"
									class="text-success">{{$item->knowledgeCategory->category}}</a></li>
							<li class="list-inline-item">
								<i class="icon-star-full2 font-size-base text-warning-300"></i>
								<i
									class="{{$item->knowledgeRating->avg('rating') >= 2?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
								<i
									class="{{$item->knowledgeRating->avg('rating') >= 3?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
								<i
									class="{{$item->knowledgeRating->avg('rating') >= 4?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
								<i
									class="{{$item->knowledgeRating->avg('rating') >= 5?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
								&nbsp; {{$item->knowledgeRating->count()}} Rattings
							</li>
							<li class="list-inline-item">{{number_format($item->views)}} Views</li>
						</ul>
						<p>{{str_limit($item->knowledge_description, 300, '...') }}</p>
					</div>
				</li>
			</ul>

		</div>
		@endforeach

		@include('search.latest_document')
		
		<ul class="pagination pagination-flat align-self-center flex-wrap my-2">
			{{ $knowledge->appends(array_merge(request()->except('page'), ['q'=> request()->q == null?'':request()->q]))->links() }}</ul>
	</div>
@include('search.latest_news')
	<!-- /search results -->
</div>
<!-- /main content -->
@endsection