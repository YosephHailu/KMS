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
	{{-- <link href="{{ asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css"> --}}
	<link href="{{ asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('global_assets/js/main/jquery.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

	<!-- /theme JS files -->
	<style>
		.content-wrapper {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-direction: column;
			flex-direction: column;
			-ms-flex: 1;
			flex: 1;
			overflow: auto;
		}

		.page-content {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-positive: 1;
			flex-grow: 1;
			padding: 1.25rem .625rem;
		}

		body {
			background-image: url("{{asset('login_bg.jpg')}}");
			height: 85px;
			
		}

	</style>
</head>

<body>

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form method="POST" class="login-form col-lg-3 col-md-5 col-sm-8" action="{{ route('login') }}">
					@csrf
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i style="color: #FF7043"
									class="icon-people icon-2x border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">{{__('auth.login_to_account')}}</h5>
								<span class="d-block text-muted">{{__('auth.enter_credentials')}}</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control" name="username" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
								{{-- {{dd($errors)}} --}}
								@if ($errors->has('username'))
								<span class="form-text text-danger">{{ $errors->first('username') }}</span>
								@endif
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" name="password" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
								@if ($errors->has('password'))
								<span class="form-text text-danger">{{ $errors->first('password') }}</span>
								@endif
							</div>

							<div class="form-group d-flex align-items-center">
								<div class="form-check mb-0">
									<label class="form-check-label">
										<input type="checkbox" name="remember" class="form-input-styled"
											{{ old('remember') ? 'checked' : '' }}>
											{{__('auth.remember_me')}}
									</label>
								</div>

								{{-- <a href="login_password_recover.html" class="ml-auto">{{__('auth.forgot_password')}}</a> --}}
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-login btn-block">{{__('auth.sign_in')}}
									<i class="spin icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="form-group">
								<a href="{{url('home') }}" class="btn btn-light btn-block">{{__('auth.cancel')}}</a>
							</div>

							<span class="form-text text-center text-muted">{{__('auth.read_our_term')}}
								read our <a href="#">{{__('auth.terms_conditions')}}</a></span>
						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
	<script>
		$('.btn-login').on('click', function(event){
		$('.spin').removeClass('icon-circle-right2');
		$('.spin').addClass('icon-spinner2 spinner')
	});
	$(document).ready(function(){
		
        if (!$().uniform) {
            console.warn('Warning - uniform.min.js is not loaded.');
            return;
        }

        // Initialize
        $('.form-input-styled').uniform();
	});
	</script>
</body>

</html>