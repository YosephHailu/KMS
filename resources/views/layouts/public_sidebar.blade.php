
<!-- Main sidebar -->
<div class="sidebar sidebar-light sidebar-main sidebar-expand-md align-self-start">

	<!-- Sidebar mobile toggler -->
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		<span class="font-weight-semibold">Main sidebar</span>
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<!-- /sidebar mobile toggler -->


	<!-- Sidebar content -->
	<div class="sidebar-content">
		<div class="card card-sidebar-mobile">

		<!-- Header -->
		<div class="card-header header-elements-inline">
			<h6 class="card-title">Navigation</h6>
			<div class="header-elements">
				<div class="list-icons">
					<a href="#" class="sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</div>
			</div>
		</div>
		<!-- /header -->

		<!-- Main navigation -->
		<div class="card-body p-0">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item">
					<a href="{{url('home')}}" class="nav-link">
						<i class="icon-home4"></i>
						<span>home</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{url('news')}}" class="nav-link">
						<i class="icon-newspaper"></i>
						<span>News</span>
					</a>
				</li>
				<li class="nav-item-header mt-0"><div class="text-uppercase font-size-xs line-height-xs">Knowledge Category</div> <i class="icon-menu" title="Knowledge Category"></i></li>
				@foreach (App\KnowledgeCategory::All() as $category)
					<li class="nav-item">
						<a href="{{url('home')}}" class="nav-link">
							{{-- <i class="icon-home4"></i> --}}
							<span>{{$category->category}}</span>
						</a>
					</li>
				@endforeach
				<!-- /main -->

			</ul>
		</div>
		<!-- /main navigation -->
		</div>
	</div>
	<!-- /sidebar content -->
</div>
<!-- /main sidebar -->
