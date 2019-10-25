@extends('layouts.app')

@section('content')

@section('breadcrumb')

<span class="breadcrumb-item active">Notice Board</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<div class="card">
			<div class="card-header bg-blue">
				<h5 class="card-title">Notice Board</h5>
			</div>

			<div class="card-body">
				<ul class="media-list media-chat media-chat-scrollable mb-3">

						<li class="media">
							<div class="mr-3 text-center">
								<a href="{{asset('storage\user_photos\\'.$noticeBoard->user->photo)}}">
									<img src="{{asset('storage\user_photos\\'.$noticeBoard->user->photo)}}"
										class="rounded-circle" width="40" height="40" alt="">
									<br>
									<small>{{$noticeBoard->user->name}}</small>
								</a>
							</div>

							<div class="media-body">
								<div class="media-chat-item">
									<p class="h5">{{$noticeBoard->header}}</p>
									{{$noticeBoard->message}}
								</div>
								<div class="font-size-sm text-muted mt-2">
									{{$noticeBoard->created_at->format('D-M-Y H:I')}}<a
										href="{{url('board/'.$noticeBoard->id)}}">
										<i class="icon-watch  text-muted"></i>
										{{$noticeBoard->attachment == "noFile.jpg"?"":"Download Attachment"}}</a>
									</div>
							</div>
						</li>
				</ul>
				<hr>
			</div>
		</div>
		<!-- /dashboard content -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->

@endsection
