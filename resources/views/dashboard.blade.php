
@if(Auth::user()->hasRole('guest'))
	@include('guest_dashboard');
@else
	@include('user_dashboard');
@endif
