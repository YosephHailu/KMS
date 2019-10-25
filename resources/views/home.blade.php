@extends('layouts.public_app')

@section('slide_show')
<div class="w-100">
	<div class="bd-example">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				@foreach (App\Slider::where('active', true)->orderByDesc('created_at')->get() as $slider)
				<div class="carousel-item {{$loop->index == 0?'active':''}}">
					<img src="{{asset('storage\slider_photos\\'.$slider->photo)}}" class="d-block w-100" 
						height="450px" alt="{{asset('man.png')}}" style="object-fit: cover;">
					<div class="carousel-caption d-none d-md-block" style="background-color: rgba(41, 182, 246, 0.4)">
						<h2 class="text-lg">{{$slider->title}}</h2>
						<p class="text-lg">{{$slider->message}}
					</div>
				</div>
				@endforeach

			</div>
			<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>
@endsection
@section('content')
<!-- Main content -->

<!-- Info blocks -->
<div class="row bg-dark p-1 mt-2">
		<div class="col-lg-4">
			<div class="mb-0">
				<div class="card-body text-center">
				<i class="icon-book icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
					<h5 class="card-title"><span>{{App\Attachment::All()->count()}}</span>
						Document</h5>
					<p class="mb-3">Ouch found swore much dear conductively hid submissively hatchet vexed far inanimately alongside candidly much and jeez</p>
					<a href="{{url('search/public?q=')}}" class="btn bg-success-400">Browse documents</a>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="mb-0">
				<div class="card-body text-center">
					<i class="icon-people icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
					<h5 class="card-title"><span>{{App\User::All()->filter(function($user){
							return $user->hasPermissionTo('manage knowledge');
						})->count()}}</span> Knowledge Contributor</h5>
					<p class="mb-3">Dear spryly growled much far jeepers vigilantly less and far hideous and some mannishly less jeepers less and and crud</p>
				</div>
			</div>
		</div>

		<div class="col-lg-4 ">
			<div class="mb-0">
				<div class="card-body text-center">
					<i class="icon-star-full2 icon-2x text-blue border-blue border-3 rounded-round p-3 mb-3 mt-1"></i>
					<h5 class="card-title"><span>{{App\Project::All()->count()}}</span> Projects</h5>
					<p class="mb-3">Diabolically somberly astride crass one endearingly blatant depending peculiar antelope piquantly popularly adept much</p>
					<a href="{{url('search/public/Project?q=')}}" class="btn bg-blue">Browse projects</a>
				</div>
			</div>
		</div>
	</div>
	<!-- /info blocks -->


<div class="card-body">
	<div class="d-md-flex">
		<ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-200 mb-md-0 border-bottom-0"
			style="min-width: 300px;">
			@foreach (App\Blog::take(5)->get() as $blog)
			<li class="nav-item"><a href="#news-tab{{$blog->id}}"
					class="nav-link text-success {{$loop->index==0?'active':''}}" data-toggle="tab"><i
						class="icon-menu7 mr-2"></i> {{$blog->title}}</a></li>
			@endforeach

		</ul>
		<div class="tab-content">
			@foreach (App\Blog::take(5)->get() as $blog)
			<div class="tab-pane fade {{$loop->index==0?'show active':''}}" id="news-tab{{$blog->id}}">
				<p class="p-1">{{str_limit($blog->message, 700, '...') }} <a href="">continue reading</a></p>
			</div>
			@endforeach
		</div>
	</div>
</div>

<div class="p-2"
	style='background-image: url("{{asset('agri-img.jpg')}}"); background-size: cover; background-attachment: fixed;'>
	@foreach (App\KnowledgeProduct::take(4)->get() as $knowledge)
	<div class="card col-lg-4 col-md-8">
		<div class="card-header pb-2">
			<h6 class="media-title p-0 m-0"><a href="#">{{$knowledge->title}}</a></h6>
		</div>

		<div class="card-body">
			<p class="px-1 text-default">{{str_limit($knowledge->knowledge_description, 100, '...') }}
				<a href="{{url('search/detail/'.$knowledge->id)}}" class="size-sm"> More </a></p>
		</div>
	</div>
	@endforeach

</div>

<div class="mt-3">
	<div class="card-body">
		<ul class="nav nav-tabs nav-tabs-bottom">
			<li class="nav-item"><a href="#about_us-tab" class="nav-link active h1" data-toggle="tab">About Us</a></li>
			<li class="nav-item"><a href="#about_system-tab" class="nav-link h1" data-toggle="tab">About The System</a>
			</li>
		</ul>

		<div class="tab-content p-2 text-justify">
			<div class="tab-pane fade show active px-3" id="about_us-tab">
				<div class="row">
					<div class="h4 text-muted">
						The Ministry of Water, Irrigation and Electricity of Ethiopia is a federal organization
						established to undertake the management of water resources, water supply and sanitation,
						large and medium scale irrigation and electricity. The Ministry is a regulatory body which
						involves the planning, development and management of resources, preparation and implementation
						of guidelines, strategies, polices, programs, and sectoral laws and regulations. It also,
						conducts study and research activities, provides technical support to regional water and
						energy bureaus and especial support to four emerging regions (Gambella, Benishangul-Gumuth,
						Afar and Somali). In the case of transboundary water resources and regional developments
						pertinent to the sector,
						it engages in the negotiation and the signing of international agreements
					</div>
				</div>
			</div>

			<div class="tab-pane fade row" id="about_system-tab">
				<div class="row">
					<div class="col-md-7 h4 text-muted">
						A knowledge management system (KMS) is a system for applying and using knowledge management
						principles.
						These include data-driven objectives around business productivity, a competitive business model,
						business intelligence analysis and more.
					</div>
					<div class="col-md-4">
						<img src="{{asset('Et-flag.png')}}" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Knowledge Map -->
<div class="row">
	@foreach(App\KnowledgeProduct::All()->filter(function ($knowledge){
	return $knowledge->accessLevel->level_number < 1; })->groupBy('directorate_id') as $id => $KnowledgeProduct)
		<div class="mb-3 col-md-4 col-lg-3">
			<h2 class="font-weight-semibold">{{App\Directorate::find($id)->name}}</h2>
			<ul class="list list-unstyled">
				@foreach ($KnowledgeProduct as $knowledgeItem)
				<li> <i class="icon-arrow-right5"></i>
					<a href="index.html">{{$knowledge->title}}</a></li>
				@endforeach

			</ul>
		</div>
		@endforeach
</div>

<!-- /Knowledge Map -->
@endsection

@section('script')
<script>
	$('.jquery_count_animate').each(function () {
  var $this = $(this);
  jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
    duration: 1000,
    easing: 'swing',
    step: function () {
      $this.text(Math.ceil(this.Counter));
    }
  });
});
</script>
@endsection