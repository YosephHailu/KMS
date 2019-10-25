@extends('layouts.public_app')

@section('content')


	<!-- Page header -->
	<div class="card content mt-1 sticky">
        <div class="card-body">
            <h5 class="mb-3">Search Our Knowledge Database</h5>

            <form action="#">
                <div class="input-group mb-3">
                    <div class="form-group-feedback form-group-feedback-left">
                        <input type="text" class="form-control form-control-lg alpha-grey" value="" placeholder="Enter key words. Eg : Nile, Gefersa">
                        <div class="form-control-feedback form-control-feedback-lg">
                            <i class="icon-search4 text-muted"></i>
                        </div>
                    </div>

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary btn-lg">Search</button>
                    </div>
                </div>

                <div class="d-md-flex align-items-md-center flex-md-wrap text-center text-md-left">
                    <ul class="list-inline list-inline-condensed mb-0">
                        <li class="list-inline-item dropdown">
                            <a href="#" class="btn btn-link text-default dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-stack2 mr-2"></i>
                                All categories
                            </a>

                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item"><i class="icon-question7"></i> Getting started</a>
                                <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Registration</a>
                                <a href="#" class="dropdown-item"><i class="icon-reading"></i> General info</a>
                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> Your settings</a>
                                <a href="#" class="dropdown-item"><i class="icon-graduation"></i> Copyrights</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"><i class="icon-mail-read"></i> Contacting authors</a>
                            </div>
                        </li>
                        <li class="list-inline-item"><a href="#" class="btn btn-link text-default"><i class="icon-reload-alt mr-2"></i> Refine your search</a></li>
                    </ul>

                </div>
            </form>
        </div>
    </div>
	<!-- /page header -->
		

	<!-- Page content -->
	<div class="page-content pt-0">

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
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>
					<!-- /header -->


					<!-- User menu -->
					<div class="sidebar-user">
						<div class="card-body">
							<div class="media">
								<div class="mr-3">
									<a href="#"><img src="global_assets/images/image.png" width="38" height="38" class="rounded-circle" alt=""></a>
								</div>

								<div class="media-body">
									<div class="media-title font-weight-semibold">Victoria Baker</div>
									<div class="font-size-xs opacity-50">
										<i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
									</div>
								</div>

								<div class="ml-3 align-self-center">
									<a href="#" class="text-white"><i class="icon-cog3"></i></a>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="card-body p-0">
						<ul class="nav nav-sidebar" data-nav-type="accordion">

							<!-- Main -->
							<li class="nav-item-header mt-0"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
							<li class="nav-item">
								<a href="../full/index.html" class="nav-link">
									<i class="icon-home4"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<li class="nav-item nav-item-submenu nav-item-expanded nav-item-open">
								<a href="#" class="nav-link"><i class="icon-stack"></i> <span>Starter kit</span></a>

								<ul class="nav nav-group-sub" data-submenu-title="Starter kit">
									<li class="nav-item"><a href="../seed/sidebar_none.html" class="nav-link">No sidebar</a></li>
									<li class="nav-item"><a href="../seed/sidebar_main.html" class="nav-link active">1 sidebar</a></li>
									<li class="nav-item nav-item-submenu">
										<a href="#" class="nav-link">2 sidebars</a>
										<ul class="nav nav-group-sub">
											<li class="nav-item"><a href="../seed/sidebar_secondary.html" class="nav-link">Secondary sidebar</a></li>
											<li class="nav-item"><a href="../seed/sidebar_right.html" class="nav-link">Right sidebar</a></li>
										</ul>
									</li>
									<li class="nav-item nav-item-submenu">
										<a href="#" class="nav-link">3 sidebars</a>
										<ul class="nav nav-group-sub">
											<li class="nav-item"><a href="../seed/sidebar_right_hidden.html" class="nav-link">Right sidebar hidden</a></li>
											<li class="nav-item"><a href="../seed/sidebar_right_visible.html" class="nav-link">Right sidebar visible</a></li>
										</ul>
									</li>
									<li class="nav-item"><a href="../seed/sidebar_sections.html" class="nav-link">Sectioned sidebar</a></li>
									<li class="nav-item"><a href="../seed/sidebar_stretched.html" class="nav-link">Stretched sidebar</a></li>
									<li class="nav-item-divider"></li>
									<li class="nav-item"><a href="../seed/navbar_main_fixed.html" class="nav-link">Main navbar fixed</a></li>
									<li class="nav-item"><a href="../seed/navbar_main_hideable.html" class="nav-link">Main navbar hideable</a></li>
									<li class="nav-item"><a href="../seed/navbar_secondary_sticky.html" class="nav-link">Secondary navbar sticky</a></li>
									<li class="nav-item"><a href="../seed/navbar_both_fixed.html" class="nav-link">Both navbars fixed</a></li>
									<li class="nav-item-divider"></li>
									<li class="nav-item"><a href="../seed/layout_boxed.html" class="nav-link">Boxed layout</a></li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="../full/changelog.html" class="nav-link">
									<i class="icon-list-unordered"></i>
									<span>Changelog</span>
									<span class="badge bg-blue-400 align-self-center ml-auto">2.0</span>
								</a>
							</li>
							<!-- /main -->

						</ul>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                        <i class="icon-book icon-2x text-success-400 border-success-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title">Knowledge Base</h5>
                            <p class="mb-3">Ouch found swore much dear conductively hid submissively hatchet vexed far inanimately alongside candidly much and jeez</p>
                            <a href="#" class="btn bg-success-400">Browse articles</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-lifebuoy icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title">Support center</h5>
                            <p class="mb-3">Dear spryly growled much far jeepers vigilantly less and far hideous and some mannishly less jeepers less and and crud</p>
                            <a href="#" class="btn bg-warning-400">Open a ticket</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="icon-reading icon-2x text-blue border-blue border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="card-title">Articles and news</h5>
                            <p class="mb-3">Diabolically somberly astride crass one endearingly blatant depending peculiar antelope piquantly popularly adept much</p>
                            <a href="#" class="btn bg-blue">Browse articles</a>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


@endsection