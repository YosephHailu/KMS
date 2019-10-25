<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{__('app.app title')}}</title>

	<!-- Global stylesheets -->
	{{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
		type="text/css"> --}}
	<link href="{{ asset('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap_water.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	@yield('css')
	<!-- Core JS files -->
	<script src="{{ asset('global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/ui/slinky.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->

	<!-- /theme JS files -->
	<style>
		* {
			font-family: sans-serif;
			font-size: 14px;
		}

		body {
			background-color: white;
		}

		.top-bar {
			/* background-image: url("{{asset('Et-flag.png')}}"); */
			/* background-repeat: no-repeat; */
			height: 85px;

		}

		.card {
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
			border: none !important;
		}

		.search-div {
			padding: 15px 40px;
			color: white;
		}

		.input-search {
			border: none;
			padding: 10px;
			padding-left: 5px !important;
			font-size: 1.1em;
		}

		.navbar-nav-link:hover {
			background-color: #4FC3F7 !important;
		}

		.navbar-nav-link {
			padding-top: 29px !important;
			padding-bottom: 29px !important;
			border-right: 1px solid aquamarine;
			min-width: 110px;
			text-align: center
		}

		.dropdown-menu {
			background-color: #4FC3F7 !important;
			min-width: 200px;
		}

		::placeholder {
			font-size: 12px;
		}

		.navbar {
			box-shadow: 0 2px 2px -2px rgba(0, 0, 0, .2);
		}
	</style>
</head>

<body>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-sm navbar-dark bg-blue">

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-more"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse pl-0" id="navbar-mobile">
			<div class="navbar-brand d-xs-none d-sm-none d-md-none d-lg-block m-0 p-0">
				<a href="{{url(Auth::check()?'/':'home')}}" class="bg-blue">
					<img src="{{asset('Ministry.png')}}" alt="" class="" style="height: 85px;"></a>
			</div>

			<span class="navbar-text ml-md-3 mr-md-auto">
			</span>

			<ul class="navbar-nav">
				<li class="nav-item m-0">
					<div class="form-group search-div m-0 mt-1  row px-2" id="searchBar">
						<div class="form-group-feedback form-group-feedback-left p-0 col-12">
							<form action="{{url('search/public')}}" method="get">
								<div class="input-group bg-blue-300 ">
									<span class="input-group-prepend">
										<span class="input-group-text bg-blue-300" style="border:none"><i
												class="icon-search4"></i></span>
									</span>
									<input type="text" name="q" id="search_input"
										class=" bg-blue-300 form-control input-search"
										placeholder="{{__('home.example')}}">
									<span class="input-group-append bg-blue-300 ">
										<span class="input-group-text bg-blue-300" style="border:none">
											<input type="submit" value="{{__('home.search')}}"
												class=" bg-blue btn-search btn-success px-3 btn float-right">
										</span>
									</span>
								</div>
							</form>
						</div>
					</div>
				</li>
				<li class="nav-item">
					<a href="{{url(Auth::check()?'/':'home')}}"
						class="navbar-nav-link text-center ml-auto">{{__('home.nav_home')}}</a>
				</li>
				<li class="nav-item">
					<a href="{{url('newsView')}}"
						class="navbar-nav-link text-center ml-auto">{{__('home.nav_news')}}</a>
				</li>

				<li class="nav-item">
					<div class="breadcrumb p-0 m-0">
						<div class="breadcrumb-elements-item dropdown p-0 m-0">
							<a href="#" class="breadcrumb-elements-item navbar-nav-link  ml-auto dropdown-toggle px-2"
								data-toggle="dropdown">
								{{__('home.nav_help')}}
							</a>

							<div class="dropdown-menu dropdown-menu-right bg-blue">
								<a href="{{url('about')}}" class="dropdown-item pr-3">{{__('home.about_us')}}</a>
								<a href="{{url('about')}}" class="dropdown-item pr-3">{{__('home.about_system')}}</a>
								<a href="{{url('help')}}" class="dropdown-item pr-3">{{__('home.nav_help')}}</a>
								<a href="{{url('contacts')}}" class="dropdown-item pr-3">{{__('home.nav_contact')}}</a>
							</div>
						</div>
					</div>
				</li>
				@guest

				<li class="nav-item">
					<a href="{{route('login')}}" class="navbar-nav-link ml-auto">
						{{__('auth.login')}}</a>
				</li>
				@else
				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<span>{{Auth::user()->name}}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{url('users/'.Auth::id())}}" class="dropdown-item text-white"><i
								class="icon-user-plus"></i> My
							profile</a>
						<a href="{{url('users/'.Auth::id().'/edit')}}" class="dropdown-item text-white"><i
								class="icon-pen2"></i>
							Edit Profile</a>
						<div class="dropdown-divider"></div>
						<a href="{{ url ('logout') }}" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();" class="text-white dropdown-item"><i
								class="icon-switch2"></i>
							Logout</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
				@endguest
			</ul>
		</div>
	</div>
	<!-- /main navbar -->
	@include('layouts.messages')

	{{-- Slide SHow --}}
	@yield('slide_show')
	{{-- / Slide Show --}}
	<!-- Main content -->
	<div class="content col-11 m-auto">

		@yield('content')
		<!-- Footer -->
	</div>
	<!-- /Main content -->

	<footer class="page-footer bg-blue font-small mdb-color">
		<hr>
		<!-- Footer Links -->
		<div class="container text-center text-md-left">

			<!-- Footer links -->
			<div class="row text-center text-left mt-3 pb-3">

				<!-- Grid column -->
				<div class="col-md-4 d-md-none d-lg-block col-lg-3 col-xl-3 mx-auto mt-3 text-center">
					<img src="{{asset('owme.jpg')}}" class="rounded-circle" width="120" height="120" alt="">

					<h6 class="text-uppercase mb-1 font-weight-bold ">{{__('home.footer_mowie')}}</h6>
					<p>Minister of water, Irrigation and Energy</p>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4 col-lg-2 col-xl-2 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">{{__('home.footer_about_the_minister')}}</h6>
					<p>
						<a href="#!" class=" text-white">Vision, Mission & Objective</a>
					</p>
					<p>
						<a href="#!" class=" text-white">Responsibilities</a>
					</p>
					<p>
				</div>
				<!-- Grid column -->

				<hr class="w-100 clearfix d-md-none">

				<!-- Grid column -->
				<div class="col-md-4 col-lg-2 col-xl-2 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold">{{__('home.footer_useful_links')}}</h6>
					@foreach (App\Link::All() as $item)
					<p>
						<a href="http://{{$item->link}}" class=" text-white">{{$item->name}}</a>
					</p>
					@endforeach
				</div>

				<!-- Grid column -->
				<hr class="w-100 clearfix d-md-none">

				<!-- Grid column -->
				<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
					<h6 class="text-uppercase mb-4 font-weight-bold"><a class="text-white" href="{{url('contacts')}}">
							{{__('contact')}}</a></h6>
					<p>
						<i class="fas fa-home"></i>Addis Ababa, Piyasa</p>
					<p>
						<i class="fas fa-envelope"></i> MOWIE@gmail.com</p>
					<p>
						<i class="fas fa-phone"></i> + 251 234 567 88</p>
					<p>
						<i class="fas fa-print"></i> + 251 234 567 89</p>
				</div>
				<!-- Grid column -->

			</div>
			<!-- Footer links -->

			<hr>

			<!-- Grid row -->
			<div class="row d-flex align-items-center">

				<!-- Grid column -->
				<div class="col-md-5">

					<!--Copyright-->
					<p class="text-center text-md-left">© 2018 Copyright:
						<a href="google.com" class=" text-white">
							<strong> MOWIE.com</strong>
						</a>
					</p>

				</div>
				<!-- Grid column -->

				<div class="breadcrumb col-md-3 p-0 m-0">
					<div class="breadcrumb-elements-item dropdown p-0 m-0">
						<a href="#" class="breadcrumb-elements-item dropdown-toggle px-2" data-toggle="dropdown">
							<i class="icon-spell-check mr-1 font-size-sm"></i>
							{{__('home.nav_language')}}
						</a>

						<div class="dropdown-menu dropdown-menu-right bg-blue">
							@foreach (App\Language::All() as $language)
							<a href="{{url('locale/'.$language->abbreviation)}}"
								class="dropdown-item {{App::islocale($language->abbreviation)?'active':''}}"><i>A</i>
								{{$language->name}}</a>
							@endforeach
						</div>
					</div>
				</div>
				<!-- Grid column -->
				<div class="col-md-4 ml-lg-0">

					<!-- Social buttons -->
					<div class="text-center text-md-right">
						<ul class="list-inline list-inline-condensed mb-2">
							<li class="list-inline-item">
								<a href="http://fb.com"
									class="btn btn-outline bg-white btn-icon text-white border-white border-2 rounded-round">
									<i class="icon-facebook"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a href="http://twitter.com"
									class="btn btn-outline bg-white btn-icon text-white border-white border-2 rounded-round">
									<i class="icon-twitter"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a href="http://youtube.com"
									class="btn btn-outline bg-white btn-icon text-white border-white border-2 rounded-round">
									<i class="icon-youtube"></i>
								</a>
							</li>
						</ul>
					</div>

				</div>
				<!-- Grid column -->

			</div>
			<!-- Grid row -->

		</div>
		<!-- Footer Links -->

	</footer>
	<!-- Footer -->

	@yield('script')
</body>
<script>
	$('.searchBarToggler').on('click', function(event){
		event.preventDefault();
		$('#searchBar').toggle();
		$('#search_input').focus();
	});
</script>

</html>