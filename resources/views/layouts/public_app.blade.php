@php
$company = App\Company::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{__('app.app title')}}</title>

	<!-- Global style sheets -->
	{{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
		type="text/css"> --}}
	<link href="{{ asset('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap_water.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	{{-- <link href="{{ asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css"> --}}
	<link href="{{ asset('css/ui-notify.css')}}" rel="stylesheet" type="text/css">

	<!-- /global style sheets -->

	@yield('css')
	<!-- Core JS files -->
	<script src="{{ asset('global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/ui/slinky.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('global_assets/js/plugins/notifications/pnotify.min.js')}}"></script>
	<!-- /theme JS files -->
	<style>
		* {
			font-family: sans-serif;
			font-size: 14px;
		}

		body {
			background-color: white;
			overflow-x: hidden;
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
			padding-right: 0px;
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

		.navbar-collapse {
			padding-right: 1px;
		}
	</style>
</head>

<body>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-sm navbar-dark bg-blue pr-0">
		<div class="d-md-none row col-12 navbar-toggler py-0 pl-3">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-paragraph-justify3"></i>
			</button>
			<div class="form-group search-div m-0 mt-1 row col-11 navbar-toggler" id="searchBar">
				<div class="form-group-feedback form-group-feedback-left p-0 ">
					<form action="{{url('search/public')}}" method="get">
						<div class="input-group bg-blue-300 ">
							<span class="input-group-prepend">
								<span class="input-group-text bg-blue-300" style="border:none"><i
										class="icon-search4"></i></span>
							</span>
							<input type="text" name="q" id="search_input" class=" bg-blue-300 form-control input-search"
								placeholder="{{__('home.example')}}" value="">
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
		</div>
		<div class="collapse navbar-collapse pl-0 pr-2" id="navbar-mobile">
			<ul class="navbar-nav col-md-4">
				<li class="nav-item">
					<div class="navbar-brand m-0 p-0">
						<a href="{{url(Auth::check()?'/':'home')}}" class="bg-blue">
							<img src="{{asset('storage\company\\'.($company != null ? $company->header_img : "nofile.jpg"))}}"
								alt="" class="" style="height: 85px;width: 100%;"></a>
					</div>
				</li>
			</ul>

			<span class="navbar-text ml-md-3 mr-md-auto d-none d-md-block d-lg-block d-lg-block d-xl-block">
			</span>

			<ul class="navbar-nav">

				<li class="nav-item m-0 d-none d-sm-block">
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
										placeholder="{{__('home.example')}}" value="">
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

				<li class="nav-item dropdown">
					<a href="{{url('help')}}" class="navbar-nav-link ml-auto" data-toggle="dropdown">
						{{__('home.nav_help')}}
					</a>

					<div class="dropdown-menu dropdown-menu-right bg-dark">
						<a href="{{url('about')}}" class="dropdown-item text-white"> {{__('home.about_us')}}</a>

						<a href="{{url('about_system')}}" class="dropdown-item text-white"> {{__('home.about_system')}}</a>

						<a href="{{url('help')}}" class="dropdown-item text-white"> {{__('home.nav_help')}}</a>

						<a href="{{url('contacts')}}" class="dropdown-item text-white"> {{__('home.nav_contact')}}</a>
					</div>
				</li>
				@guest

				<li class="nav-item">
					<a href="{{route('login')}}" class="navbar-nav-link ml-auto">
						{{__('auth.login')}}</a>
				</li>
				@else
				<li class="nav-item dropdown" style="min-width:150px;">
					<a href="#" class="navbar-nav-link ml-auto" data-toggle="dropdown">
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

	{{-- Slide SHow --}}
	@yield('slide_show')
	{{-- / Slide Show --}}
	<!-- Main content -->
	<div class="content col-11 m-auto">

		@yield('content')
		<!-- Footer -->
	</div>
	<!-- /Main content -->
	@include('layouts.footer')
	@include('layouts.messages')
	@yield('script')

	<script>
		$('.searchBarToggler').on('click', function(event){
		event.preventDefault();
		$('#searchBar').toggle();
		$('#search_input').focus();
	});
	</script>

</body>

</html>