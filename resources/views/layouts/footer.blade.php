
	<footer class="page-footer bg-blue font-small mdb-color">
		<hr>
		<!-- Footer Links -->
		<div class="container text-center p-0 text-md-left">

			<!-- Footer links -->
			<div class="row text-center p-0 text-md-left mt-3 pb-3">

				<!-- Grid column -->
				<div class="col-md-3 col-lg-3 text-center">
					<img src="{{asset('owme.jpg')}}" class="rounded-circle" width="120" height="120" alt="">

					<h6 class="text-uppercase mb-1 font-weight-bold ">{{__('app.footer_mowie')}}</h6>
					<p>{{__('app.footer_about_mowie')}}</p>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-3 col-lg-3 text-center">
					<h6 class="text-uppercase font-weight-bold">{{__('app.footer_about_the_minister')}}</h6>
					<p>
						<a href="#!" class=" text-white">Vision, Mission & Objective</a>
					</p>
					<p>
						<a href="#!" class=" text-white">Responsibilities</a>
					</p>
					<p>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-3 col-lg-3 text-center">
					<h6 class="text-uppercase font-weight-bold">{{__('app.footer_useful_links')}}</h6>
					@foreach (App\Link::All() as $item)
					<p>
						<a href="http://{{$item->link}}" class=" text-white">{{$item->name}}</a>
					</p>
					@endforeach
				</div>

                <!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-3 col-lg-3 text-center">
					<h6 class="text-uppercase font-weight-bold">{{__('app.footer_contact')}}</h6>
					<p>
						<i class="fas fa-home mr-3"></i>Addis Ababa, Piyasa</p>
					<p>
						<i class="fas fa-envelope mr-3"></i> MOWIE@gmail.com</p>
					<p>
						<i class="fas fa-phone mr-3"></i> + 251 234 567 88</p>
					<p>
						<i class="fas fa-print mr-3"></i> + 251 234 567 89</p>
				</div>
				<!-- Grid column -->

			</div>
			<!-- Footer links -->

			<hr>

			<!-- Grid row -->
			<div class="row d-flex align-items-center">

				<!-- Grid column -->

					<!--Copyright-->
					<p class="text-center text-md-left">© 2018 Copyright:
						<a href="google.com" class=" text-white">
							<strong> OWNER</strong>
						</a>
					</p>

				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-5 col-lg-4 ml-lg-0">

					<!-- Social buttons -->
					<div class="text-center text-md-right">
						<ul class="list-unstyled list-inline">
							<li class="list-inline-item">
								<a class="btn-floating btn-sm  rgba-white-slight mx-1">
									<i class="fab fa-facebook-f"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a class="btn-floating btn-sm rgba-white-slight mx-1">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a class="btn-floating btn-sm rgba-white-slight mx-1">
									<i class="fab fa-google-plus-g"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a class="btn-floating btn-sm rgba-white-slight mx-1">
									<i class="fab fa-linkedin-in"></i>
								</a>
							</li>
						</ul>
					</div>

				</div>
				<!-- Grid column -->

			</div>
			<!-- Grid row -->
		</div>
	</footer>