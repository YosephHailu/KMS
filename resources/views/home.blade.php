@extends('layouts.public_app')

@section('slide_show')
<div class="w-100">
	<div class="bd-example">
		<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				@foreach (App\Slider::where('active', true)->orderByDesc('created_at')->get() as $slider)
				<div class="carousel-item {{$loop->index == 0?'active':''}}">
					<img src="{{asset('storage\slider_photos\\'.$slider->photo)}}" class="d-block w-100" height="450px"
						alt="{{asset('man.png')}}" style="object-fit: cover;">
					<div class="carousel-caption" style="background-color: rgba(41, 182, 246, 0.4)">
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
				<i
					class="icon-book icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
				<h5 class="card-title"><span>{{App\Attachment::All()->count()}}</span>
					Documents</h5>
				<p class="mb-3">{{__('home.total_knowledge_product')}} </p>
				<a href="{{url('search/public?q=')}}" class="btn bg-success-400">Browse documents</a>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="mb-0">
			<div class="card-body text-center">
				<i
					class="icon-people icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
				<h5 class="card-title"><span>{{App\User::All()->filter(function($user){
							return $user->hasPermissionTo('manage knowledge');
						})->count()}}</span> Knowledge Contributors</h5>
				<p class="mb-3">{{__('home.total_contributor')}} </p>
			</div>
		</div>
	</div>

	<div class="col-lg-4 ">
		<div class="mb-0">
			<div class="card-body text-center">
				<i class="icon-star-full2 icon-2x text-blue border-blue border-3 rounded-round p-3 mb-3 mt-1"></i>
				<h5 class="card-title"><span>{{App\Project::All()->count()}}</span> Projects</h5>
				<p class="mb-3">{{__('home.total_project')}} </p>
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
				<p class="p-1">{{str_limit($blog->message, 700, '...') }} <a href="{{url('news/'.$blog->id)}}">continue reading</a></p>
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
						The Ministry of Water, Irrigation and Energy of Ethiopia is a federal organization
						established to undertake the management of water resources, water supply and sanitation,
						large and medium scale irrigation and Energy. The Ministry is a regulatory body which
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
					<div>
						The Ethiopia Government Growth and Transformation Plan (GTP II: 2015-2020) is catalyzing major strategic shiftsin the sector, promotinginfrastructure development to align with that of middle-income countries. GTP II emphasizes lessons learned and pulls frompast experiences to promote and sustain reliable change in the WASH sector. Knowledge generated will be applied and scaled up across the nation to speed up and ensure structural changes.
						Additionally, the ONE WASH National Program (OWNP) emphasizes the need for a robust knowledge management system.Ongoing OWNP updates prioritize the review of existing policies, strategies, guidelines and manuals related to Knowledge Management (KM) and its implementation. This initiative and WASH Inventory IIare closely related to this project and will factor in to its implementation.						
						DAI, the prime implementer of the USAID-funded Water for Africa through Leadership and Institutional Support (WALIS), has worked closely with the Ethiopian Ministry of Water Irrigation and Energy (MoWIE) to determine the activities that would best serve their needs. DAI has subcontracted WaterAid, under the Improving WASH Evidence-Based Decision-Making(IWED) program, to support the Ministry in WASH sector monitoring. WaterAid has assigned subcontract for ICT4Development Consulting Plc to develop KMS application platform.
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Knowledge Map -->
<div class="row">
	@foreach(App\KnowledgeProduct::All()->filter(function ($knowledge){
	return $knowledge->accessLevel->level_number < 1 && $knowledge->approved; })->groupBy('directorate_id') as $id =>
		$KnowledgeProduct)
		<div class="mb-3 col-md-4 col-lg-3">
			<h2 class="font-weight-semibold">{{App\Directorate::find($id)->name}}</h2>
			<ul class="list list-unstyled">
				@foreach ($KnowledgeProduct->take(5) as $knowledgeItem)
				<li> <i class="icon-arrow-right5"></i>
					<a href="{{url('search/detail/'.$knowledgeItem->id)}}">{{$knowledgeItem->title}}</a></li>
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