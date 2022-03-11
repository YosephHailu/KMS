@extends('layouts.public_app')

@section('content')

<div class="card mt-3 mx-auto col-10">
	<div class="card-body">
		<div class="mt-1 mb-4 " id="#searching">
			<h3 class="font-weight-semibold text-blue">Frequent Asked Question (FAQ) </h3>
		</div>
		<dl>
		<a href="#searching" class="font-size-sm font-weight-bold text-uppercase ">
				<i class="icon-question4 text-blue mr-2"></i>
				How can I search knowledge products?
		</a>
	</dl>
	<dl>
		<a href="{{url('search/public/?q=training manual')}}" class="font-size-sm font-weight-bold text-uppercase ">
				<i class="icon-question4 text-blue mr-2"></i>
				If you have need further information, please search and download training manual.
		</a>
	</dl>
	</div>
</div>
<div class="card mt-3 mx-auto col-10">
	<div class="card-body">
		<div class="mt-1 mb-4">
			<h3 class="font-weight-semibold text-blue">1. Header Menu of the Home page</h3>
			<p>The home interface of KMS has many graphic menus. Figure 1 shows the overall interface of the system</p>
			<img src="{{asset('help_img/home_page.png')}}" width="100%" alt="">
		</div>
		<div class="mt-1 mb-4 ">
			<h3 class="font-weight-semibold text-blue">2. Body menu of the KMS </h3>
			<p>Next to header interface, the system summarized and informs users to have information about total WASH
				knowledge products uploaded,
				number of knowledge contributors and projects. </p>
			<img src="{{asset('help_img/home_statistics.png')}}" width="100%" alt="">
		</div>
		<div class="mt-1 mb-4 " id="#searching">
			<h3 class="font-weight-semibold text-blue">3. Searching </h3>

			<div class="mb-4">
				<dl>

					<dt class="font-size-sm font-weight-bold text-uppercase ">
						<i class="icon-checkmark3 text-blue mr-2"></i>
						Type key words on search field
					</dt>
					<dt class="font-size-sm font-weight-bold text-uppercase p-1">
						<i class="icon-checkmark3 text-blue mr-2"></i>
						Click search search button or press enter
					</dt>
					<dt class="font-size-sm font-weight-bold text-uppercase p-1">
						<i class="icon-checkmark3 text-blue mr-2"></i>
						If the knowledge product is not displayed on the system,
						please try changing other key word and repeating the above steps
					</dt>

				</dl>
			</div>
			<h3 class="font-weight-semibold text-blue ml-3"> Search result interface </h3>
			<img src="{{asset('help_img/search_result.png')}}" width="100%" alt="">
		</div>
	</div>
</div>
@endsection

@section('script')

@endsection