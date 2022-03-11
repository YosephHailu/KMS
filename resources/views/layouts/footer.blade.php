<footer class="page-footer bg-blue font-small mdb-color">
	<hr>
	<!-- Footer Links -->
	<div class="container text-center text-md-left">

		<!-- Footer links -->
		<div class="row text-center text-left mt-3 pb-3">

			<!-- Grid column -->
			<div class="col-md-4 d-md-none d-lg-block col-lg-3 col-xl-3 mx-auto mt-3 text-center">
				<img src="{{asset('storage\company\\'.($company != null ? $company->logo : "nofile.jpg"))}}" class="rounded-circle" width="120" height="120" alt="">
				<h6 class="text-uppercase mb-1 font-weight-bold ">{{$company != null ? $company->abbreviation:"Organization Name"}}</h6>
				<p>{{$company != null ? $company->name : "Organization Name"}}</p>
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
					<i class="fas fa-home"></i>{{$company != null ? $company->address: "Address"}}</p>
				<p>
					<i class="fas fa-envelope"></i>{{$company != null ? $company->email : "Email"}}</p>
				<p>
					<i class="fas fa-phone"></i> {{$company != null ? $company->fixed_line : "Fixed Line"}}</p>
				<p>
					<i class="fas fa-print"></i> {{$company != null ? $company->fax : "Fax"}}</p>
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
				<p class="text-center text-md-left">© 2019 Copyright:
					<a href="{{$company != null ? $company->url: ""}}" class=" text-white">
						<strong> {{$company != null ? $company->website: "Website"}}</strong>
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
							<a href="http://{{$company != null ? $company->fb_url : "fb.com"}}"
								class="btn btn-outline bg-white btn-icon text-white border-white border-2 rounded-round">
								<i class="icon-facebook"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="http://{{$company != null ? $company->twitter_url : "twitter.com"}}"
								class="btn btn-outline bg-white btn-icon text-white border-white border-2 rounded-round">
								<i class="icon-twitter"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="http://{{$company != null ? $company->youtube_url: "youtube.com"}}"
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