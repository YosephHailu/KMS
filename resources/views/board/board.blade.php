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

					@foreach ($noticeBoards as $noticeBoard)
						@if($noticeBoard->user_id == Auth::Id())
						<li class="media media-chat-item-reverse">

							<div class="media-body">
								<div class="media-chat-item">
									<a href="{{url('board/'.$noticeBoard->id.'/detail')}}" class="h5">{{$noticeBoard->header}}</a><br>
									{{str_limit($noticeBoard->message, 300, '...') }}
								</div>
								<div class="font-size-sm text-muted mt-3">
									{{$noticeBoard->created_at->format('D-M-Y H:I')}}<a
										href="{{url('board/'.$noticeBoard->id)}}">
										<i class="icon-watch  text-muted"></i>
										{{$noticeBoard->attachment == "noFile.jpg"?"":"Download Attachment"}}</a>
										<i class="icon-trash text-danger ml-2"></i>										
										<a href="#" id="{{$noticeBoard->id}}" class="btn-delete-message"> Delete Message</a></div>
							</div>
							
							<div class="ml-3">
								<a href="{{asset('storage\user_photos\\'.$noticeBoard->user->photo)}}">
									<img src="{{asset('storage\user_photos\\'.$noticeBoard->user->photo)}}"
										class="rounded-circle" width="40" height="40" alt="">
									<br>
									<small>{{$noticeBoard->user->name}}</small>
								</a>
							</div>
						</li>
						@else
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
						@endif
					@endforeach
				</ul>
				{{$noticeBoards->links()}}
				<hr>
				{!! Form::open(['action' => ['NoticeBoardController@store'], 'method'=>
				'POST','enctype'=>'multipart/form-data']) !!}
				<div class="form-group">
					{{Form::label('header', 'Subject *')}}
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-check"></i></span>
						{{Form::text('header',null, ['class'=>'form-control','placeholder'=>'Header'])}}
					</div>
				</div>
				<textarea name="message" class="form-control mb-3" rows="3" cols="1"
					placeholder="Enter your message..."></textarea>

				<div class="form-group">
					{{Form::label('file', 'Attachment *')}}
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-check"></i></span>
						{{Form::file('file',['class'=>'form-control '])}}
					</div>
				</div>

				<div class="d-flex align-items-center">
					<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto"><b><i
								class="icon-paperplane"></i></b> Send</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
		<!-- /dashboard content -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->


<!-- .modal -->
<div id="modal-confirm-deletion" class="modal fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete Message</h5>
			</div>
			<div class="modal-body">
				<p>Press Continue To Delete Message From Board</p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-message-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

@endsection

@section('script')

<script>
	var messageId = 0;
	var token = '{{Session::token()}}';

    $('.btn-delete-message').on('click', function(event){
        event.preventDefault();
        messageId = this.id;
        $('#modal-confirm-deletion').modal();
    });
    $('.btn-delete-message-confirm').on('click', function(event){
        event.preventDefault();
        var url = "{{url('board')}}/"+messageId; 
        $.ajax({
            method: 'delete',
            url: url,
            data: {_token: token}
        }).done(function(msg){
			new PNotify({
				text: msg,
				addclass: 'bg-success border-primary'
			});
            location.reload();
        }).fail(function(msg){
            console.log(msg);
        });
    });
</script>
@endsection