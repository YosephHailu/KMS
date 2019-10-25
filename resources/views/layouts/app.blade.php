<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>{{__('app.app title')}}</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
		type="text/css">
	<link href="{{ asset('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/bootstrap_water.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">

	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script src="{{ asset('global_assets/js/main/jquery.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>


	<script src="{{ asset('assets/js/app.js')}}"></script>
	<script src="{{ asset('global_assets/js/demo_pages/navbar_multiple_sticky.js')}}"></script>

	<script src="{{ asset('global_assets/js/plugins/notifications/pnotify.min.js')}}"></script>

	@yield('css')
	<!-- /theme JS files -->
</head>

<body>

	<div class="form-group collapse search-div bg-blue-300 m-0 row" style="z-index: 10" id="searchBar">
		<div class="form-group-feedback form-group-feedback-left col-12">
			<form action="{{url('search/public')}}" method="get">
				<div class="input-group">
					<span class="input-group-prepend">
						<span class="input-group-text bg-blue-300" style="border:none"><i
								class="icon-search4"></i></span>
					</span>
					<input type="text" name="q" class="form-control input-search bg-blue-300"
						placeholder="{{__('app.example')}}">
					<span class="input-group-append">
						<span class="input-group-text bg-blue-300" style="border:none">
							<input type="submit" value="{{__('app.search')}}"
								class="btn-search btn-success px-3 btn float-right">
						</span>
					</span>
				</div>
			</form>
		</div>
	</div>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark bg-blue mb-2">
		<div class="navbar-brand">
			<a href="{{url('/')}}" class="d-inline-block">
				<img src="{{asset('global_assets/images/logos.png')}}" alt="">
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler searchBarToggler">
				<i class="icon-search4"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-secondary-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-more"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">

			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-secondary-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>

			<span class="navbar-text ml-md-3 mr-md-auto">
			</span>

			<ul class="navbar-nav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="#" class="navbar-nav-link searchBarToggler" id="searchBarToggler">
							<i class="icon-search4"></i>
						</a>
					</li>
				</ul>

				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
						<i class="icon-bubbles5"></i>
						<span class="d-md-none ml-2">{{__('app.nav_messages')}}</span>
						<span
							class="badge badge-pill badge-mark bg-orange-400 border-orange-400 ml-auto ml-md-0"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
						<div class="dropdown-content-header">
							<span class="font-weight-semibold">{{__('app.nav_your_activities')}}</span>
						</div>

						<div class="dropdown-content-body dropdown-scrollable">
							<ul class="media-list">
								@foreach (Auth::user()->userLog()->take(7)->get() as $userLog)
								<li class="media">
									<div class="mr-3 position-relative">

										<div class="media-body">
											<div class="media-title">
												<a href="{{url(''.$userLog->affected_url)}}">
													<span class="font-weight-semibold">{{$userLog->operation}}</span>
													<span class="text-muted float-right font-size-sm pl-3">
														{{\Carbon\Carbon::parse($userLog->created_at)->format('D-M-Y')}}</span>
												</a>
											</div>

											<span class="text-muted">{{str_limit($userLog->action, 120, "...")}}</span>
										</div>
								</li>
								@endforeach
							</ul>
						</div>

						<div class="dropdown-content-footer justify-content-center p-0">
							<a href="{{url('board')}}" class="bg-light text-grey w-100 py-2" data-popup="tooltip"
								title="{{__('app.nav_load_more')}}"><i class="icon-menu7 d-block top-0"></i></a>
						</div>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
						<i class="icon-bubbles4"></i>
						<span class="d-md-none ml-2">Messages</span>
						<span class="badge badge-pill bg-warning-400 ml-auto ml-md-0">2

						</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
						<div class="dropdown-content-header">
							<span class="font-weight-semibold">{{__('app.nav_message')}}</span>
							{{-- <a href="#" class="text-default"><i class="icon-compose"></i></a> --}}
						</div>

						<div class="dropdown-content-body dropdown-scrollable">
							<ul class="media-list">
								@foreach (App\NoticeBoard::orderByDesc('created_at')->take(7)->get() as $noticeBoard)
								<li class="media">
									<div class="mr-3">
										<a href="#" class="btn bg-success-400 rounded-round btn-icon"><i
												class="icon-comment"></i></a>
									</div>

									<div class="media-body">
										<a href="#">{{$noticeBoard->user->name}}</a>
										{{str_limit($noticeBoard->message, 100, "...")}}
										<div class="font-size-sm text-muted mt-1">
											{{\Carbon\Carbon::parse($noticeBoard->created_at)->format('D/M/Y')}}</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>

						<div class="dropdown-content-footer justify-content-center p-0">
							<a href="#" class="bg-light text-grey w-100 py-2" data-popup="tooltip"
								title="{{__('app.nav_load_more')}}"><i class="icon-menu7 d-block top-0"></i></a>
						</div>
					</div>
				</li>
				<li class="nav-item" style="min-width: 110px">
					<div class="breadcrumb justify-content-center">
						<div class="breadcrumb-elements-item dropdown p-0">
							<a href="#" class="breadcrumb-elements-item dropdown-toggle mt-1 ml-2"
								data-toggle="dropdown">
								<i class="icon-spell-check mr-1 font-size-sm"></i>
								{{__('app.nav_language')}}
							</a>

							<div class="dropdown-menu dropdown-menu-right">
								@foreach (App\Language::All() as $language)
								<a href="{{url('locale/'.$language->abbreviation)}}"
									class="dropdown-item {{App::islocale($language->abbreviation)?'active':''}}"><i>A</i>
									{{$language->name}}</a>
								@endforeach
							</div>
						</div>
					</div>
				</li>
				<li class="nav-item dropdown dropdown-user" style="min-width: 120px">
					<a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="{{asset('storage\user_photos\\'.Auth::user()->photo)}}" class="rounded-circle" alt="">
						<span>{{Auth::user()->name}}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{url('users/'.Auth::id())}}" class="dropdown-item"><i
								class="icon-user"></i>{{__('app.nav_my_profile')}}</a>
						<a href="{{url('users/'.Auth::id().'/edit')}}" class="dropdown-item"><i class="icon-pen2"></i>
							{{__('app.nav_edit_profile')}}</a>
						<div class="dropdown-divider"></div>
						<a href="{{ url ('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i>
							{{__('app.nav_logout')}}</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

	<!-- Page content -->
	<div class="page-content pt-0">
		<!-- Main sidebar -->
		@include('layouts.side_bar')
		<!-- /main sidebar -->
		@yield('content')
	</div>
	@include('layouts.footer')
	<!-- Footer -->
	@include('layouts.messages')
	@yield('script')

	<script>
		$('.searchBarToggler').on('click', function(event){
			event.preventDefault();
			$('#searchBar').toggle();
		});
	</script>
</body>

</html>