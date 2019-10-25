<div class="col-lg-4">
	<span class="text-muted">{{__('search.latest news')}}</span>
	<div class="card card-body my-3">
		@foreach (App\Blog::take(5)->get() as $blog)
		<div class="media p-0 m-0">
			<div class="media-body">
				<h6 class="media-title"><a href="{{url('news/'.$blog->id)}}">{{$blog->title}}</a></h6>
				<p class="p-1 text-muted">{{str_limit($blog->message, 100, '...') }}</p>
			</div>
		</div>
		@endforeach
	</div>
</div>