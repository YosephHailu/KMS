@extends('layouts.app')

@section('content')

@section('breadcrumb')

<a href="{{url('knowledge')}}" class="breadcrumb-item"> Knowledge Product</a>
<span class="breadcrumb-item active">{{$knowledge->title}}</span>
@endsection

<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="card card-body ">
					<div class="media">
						<div class="">
							<h6 class="media-title ">
								<a href="#" class="font-weight-semibold">{{$knowledge->title}}</a>
								<span
									class="text-muted float-right ml-3">{{\Carbon\Carbon::parse($knowledge->created_at)->format('d, M, Y')}}</span>
								<a href="#" class="float-right" data-toggle="modal" data-target="#modal_rate">Rate</a>

							</h6>
							<ul class="list-inline list-inline-dotted text-muted mb-2">
								<li class="list-inline-item"><a href="#"
										class="text-success">{{$knowledge->knowledgeCategory->category}}</a></li>
								<li class="list-inline-item">
									<i class="icon-star-full2 font-size-base text-warning-300"></i>
									<i
										class="{{$knowledge->knowledgeRating->avg('rating') >= 2?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
									<i
										class="{{$knowledge->knowledgeRating->avg('rating') >= 3?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
									<i
										class="{{$knowledge->knowledgeRating->avg('rating') >= 4?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
									<i
										class="{{$knowledge->knowledgeRating->avg('rating') >= 5?'icon-star-full2':'icon-star-empty3'}} font-size-base text-warning-300"></i>
									&nbsp; {{$knowledge->knowledgeRating->count()}} Rattings
								</li>
								<li class="list-inline-item"><span class="text-blue">Views :</span>
									{{number_format($knowledge->views)}}
								</li>

							</ul>

							<ul class="list-inline list-inline-dotted  mb-2">
								<li class="list-inline-item text-primary">Source : <span
										class="text-muted">{{$knowledge->source}}</span></li>
								<li class="list-inline-item text-primary">Contact : <span
										class="text-muted">{{$knowledge->contact}}</span></li>
								<li class="list-inline-item text-primary">Directorate : <span
										class="text-muted">{{$knowledge->directorate->name}}</span></li>
							</ul>
							{{-- Extended kindness trifling remember he confined outlived if. Assistance sentiments yet unpleasing say. Open they an busy they my such high. An active dinner wishes at unable hardly no talked on. Immediate him her resolving his favourite. Wished denote abroad at branch at. Mind what no by kept. --}}

							<div class="font-size-large">
								{{$knowledge->knowledge_description}}
							</div>
						</div>

					</div>
				</div>
				@if($knowledge->project != null)
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Project Information</h5>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="text-primary" style="width:30%">Project Status</td>
									<td class="text-muted">{{$knowledge->project->projectStatus->status}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">Project Status</td>
									<td class="text-muted">{{$knowledge->project->projectCategory->category}}</td>
								</tr>
								<tr>
									<td class="text-primary">Starting And End Date</td>
									<td class="text-muted">
										{{\Carbon\Carbon::parse($knowledge->project->starting_date)->format('d, M, Y')}}
										--/--
										{{\Carbon\Carbon::parse($knowledge->project->end_date)->format('d, M, Y')}}</td>
								</tr>
								<tr>
									<td class="text-primary">Contract Number</td>
									<td class="text-muted">{{$knowledge->project->contract_no}}</td>
								</tr>
								<tr>
									<td class="text-primary">Project Manager</td>
									<td class="text-muted">{{$knowledge->project->manager}}</td>
								</tr>
								<tr>
									<td class="text-primary">Finance Source</td>
									<td class="text-muted">{{$knowledge->project->finance->donner_name}}</td>
								</tr>
								<tr>
									<td class="text-primary">Budget</td>
									<td class="text-muted">{{number_format($knowledge->project->budget)}}</td>
								</tr>
								<tr>
									<td class="text-primary">Project Description</td>
									<td class="text-muted">{{$knowledge->project->project_description}}</td>
								</tr>
								<tr>
									<td class="text-primary">Outcome</td>
									<td class="text-muted">{{$knowledge->project->outcome}}</td>
								</tr>

								<tr>
									<td class="text-primary">Beneficiary Regions</td>
									<td class="text-muted">
										<div class=" form-group-feedback form-group-feedback-left">
											{{Form::text('keywords', $knowledge->project->beneficiaries_region,
																['class'=>'tokenfield form-control','data-fouc', 'disabled'])}}
										</div>
									</td>
								</tr>

								<tr>
									<td class="text-primary">Beneficiary Weredas</td>
									<td class="text-muted">
										<div class=" form-group-feedback form-group-feedback-left">
											{{Form::text('keywords', $knowledge->project->wereda_kebele,
																['class'=>'tokenfield form-control','data-fouc', 'disabled'])}}
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				@endif
				@if($knowledge->document != null)
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Document Information</h5>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="text-primary" style="width:30%">Document Type</td>
									<td class="text-muted">{{$knowledge->document->documentCategory->category}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">Issued Date</td>
									<td class="text-muted">{{$knowledge->document->issued_date}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				@endif

				@if($knowledge->photo != null)
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Photo Information</h5>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="text-primary" style="width:30%">Photographer</td>
									<td class="text-muted">{{$knowledge->photo->photographer}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">Event Date</td>
									<td class="text-muted">{{$knowledge->photo->event_date}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				@endif
				@if($knowledge->video != null)
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Video Information</h5>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="text-primary" style="width:30%">Goal</td>
									<td class="text-muted">{{$knowledge->video->goal}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">Photographer</td>
									<td class="text-muted">{{$knowledge->video->created_date}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<!-- Video grid -->
				<div class="row">
					@foreach ($knowledge->video->knowledgeProduct->attachments as $videoAttachment)
					<div class="col-sm-6 col-xl-4">
						<div class="card">
							<div class="card-img-actions mx-1 mt-1">
								<div class="card-img embed-responsive embed-responsive-16by9">
									<video controls='true'>
										<source src="{{url('getAttachment/'.$videoAttachment->id)}}" />
									</video>
								</div>
							</div>

							<div class="card-footer">
								<p>{{$videoAttachment->title}}</p>
								{{\Carbon\Carbon::parse($knowledge->video->created_date)->format('D-M-Y')}}
								<div class="float-right">
									<a href="{{url('attachment/'.$videoAttachment->id)}}" class="list-icons-item"><i class="icon-download top-0"></i></a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<!-- /video grid -->
				@endif

				@if($knowledge->map != null)
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Map Information</h5>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="text-primary" style="width:30%">Map Type</td>
									<td class="text-muted">{{$knowledge->map->mapType->type}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">Created Date</td>
									<td class="text-muted">{{$knowledge->map->created_date}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				@endif

				<div class="card">
					<div class="card-header header-elements-sm-inline">
						<h6 class="card-title font-weight-semibold">Comments</h6>
						<div class="header-elements">
							<ul class="list-inline list-inline-dotted text-muted mb-0">
								<li class="list-inline-item">{{number_format($knowledge->knowledgeComment->count())}}
									comments</li>
								<a class="list-icons-item" data-action="collapse"></a>

							</ul>
						</div>
					</div>

					<div class="card-body">
						<ul class="media-list">
							@foreach ($knowledge->knowledgeComment as $comment)
							<li class="media flex-column flex-md-row">
								<div class="mr-md-3 mb-2 mb-md-0">
									<a href="#"><img src="{{asset('storage/user_photos/'.$comment->user->photo)}}"
											class="rounded-circle" width="38" height="38" alt=""></a>
								</div>

								<div class="media-body">
									<div class="media-title">
										<a href="#" class="font-weight-semibold">{{$comment->user->name}}</a>
										<span class="text-muted ml-3">{{$comment->created_at}}</span>
										@if ($comment->user->id == Auth::Id())
										<a class="btn-delete-comment" href="#" id="{{$comment->id}}">
											<i class="icon-trash float-right text-danger"></i></a>
										@endif
									</div>

									<p>{{$comment->message}}</p>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="card">
					<div class="card-header">
						<span class="text-muted"><span class="text-primary"> {{Auth::User()->name}}</span> Comment On
							The Topic</span>
					</div>
					<div class="card-body">
						{!! Form::open(['action' => ['KnowledgeCommentController@store'], 'method'=>
						'POST','enctype'=>'multipart/form-data']) !!}
						{{Form::textarea('message', "" ,['class'=>'form-control mb-3',"rows"=>"3", "cols"=>"1", "placeholder"=>"Enter your message..."])}}

						{{Form::hidden('knowledge_product_id',$knowledge->id)}}
						<div class="d-flex align-items-center">
							<button type="submit" class="btn bg-blue-400 btn-labeled btn-labeled-right ml-auto">
								<b><i class="icon-comment"></i></b> Comment</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">

				<div class="card card-body p-2 bg-blue m-0">
					<div class="media">
						<div class="media-body">
							<h6 class="media-title font-weight-semibold">Documents / Attachments</h6>
						</div>
					</div>
				</div>
				<div class="card card-body">
					@foreach ($knowledge->attachments as $attachment)
					<div class="media">
						<div class="media-body">
							<h6 class="media-title font-weight-semibold">{{$attachment->title}}</h6>
							<span class="text-muted">{{$attachment->downloads}} <span class="text-purple-300"> :
									Downloads</span> </span>
						</div>

						<div class="ml-3 align-self-center">
							<a href="{{url('attachment/'.$attachment->id)}}" class="text-blue"><i
									class="icon-download"></i></a>
						</div>

						<div class="ml-3 align-self-center">
							<a href="#" class="text-danger btn-delete-attachment" id="{{$attachment->id}}"><i
									class="icon-trash"></i></a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<!-- /dashboard content -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->

<!-- .modal -->
<div id="modal-confirm-deletion" class="modal modal-danger fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h5 class="modal-title">Delete !!!</h5>
			</div>
			<div class="modal-body">
				<p>Press continue to delete </p>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-danger btn-delete-comment-confirm p-x-md"
					data-dismiss="modal">Continue</button>
				<button type="button" class="btn btn-danger btn-delete-attachment-confirm p-x-md"
					data-dismiss="modal">Continue</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->

<!-- .modal -->
<div id="modal_rate" class="modal modal-danger fade animate" data-backdrop="true" style="display: none;"
	aria-hidden="true">
	<div class="modal-dialog zoom" id="animate" ui-class="zoom">
		<div class="modal-content bg-primary">
			<div class="modal-header">
				<h5 class="modal-title">Delete Comment</h5>
			</div>
			{!! Form::open(['action' => ['KnowledgeRatingController@store'], 'method'=>
			'POST','enctype'=>'multipart/form-data']) !!}
			<div class="modal-body">
				<ul class="list-inline list-inline-dotted text-muted mb-2">
					<li class="list-inline-item">
						<a><i id="star1" onClick="rating(1)"
								class="icon-star-full2 font-size-large text-warning-300"></i></a>
						<i id="star2" onClick="rating(2)" class="icon-star-full2 font-size-large text-warning-300"></i>
						<i id="star3" onClick="rating(3)" class="icon-star-full2 font-size-large text-warning-300"></i>
						<i id="star4" onClick="rating(4)" class="icon-star-full2 font-size-large text-warning-300"></i>
						<i id="star5" onClick="rating(5)" class="icon-star-full2 font-size-large text-warning-300"></i>
						<span class="text-white selected_rate">
							{{Form::text('rating','5',['class'=>' selected_rate_input col-sm-2'])}}
							{{Form::hidden('knowledge_product_id',$knowledge->id)}}

							&nbsp; Max - 5 stars

						</span>
					</li>

				</ul>
			</div>

			<div class="modal-footer" style="clear:both">
				<button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
				{{-- {{Form::hidden('_method','PUT')}} --}}

				<button type="submit" class="btn btn-success p-x-md">Continue</button>
			</div>
			{!! Form::close() !!}
		</div><!-- /.modal-content -->
	</div>
</div>
<!-- / .modal -->
@endsection

@section('script')
<script src="{{ asset('global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>
<script src="{{ asset('global_assets/js/demo_pages/form_tags_input.js')}}"></script>

<script>
	$(document).ready(function(){
			$('body').addClass('sidebar-xs');
		});
		var commentId = 0;
		var attachmentId = 0;
		var token = '{{Session::token()}}';

		$('.btn-delete-comment').on('click', function(event){
			event.preventDefault();
			$('.btn-delete-attachment-confirm').hide();
			$('.btn-delete-comment-confirm').show();
			commentId = this.id;
			$('#modal-confirm-deletion').modal();
		});
		
		$('.btn-delete-comment-confirm').on('click', function(event){
			event.preventDefault();
			var url = "{{url('knowledgeComment')}}/"+commentId; 
			$.ajax({
				method: 'delete',
				url: url,
				data: {_token: token}
			}).done(function(msg){
				console.log(msg);
				location.reload();
			}).fail(function(msg){
				console.log(msg);
			});
		});
		
		$('.btn-delete-attachment').on('click', function(event){
			event.preventDefault();
			$('.btn-delete-attachment-confirm').show();
			$('.btn-delete-comment-confirm').hide();
			attachmentId = this.id;
			$('#modal-confirm-deletion').modal();
		});
		
		$('.btn-delete-attachment-confirm').on('click', function(event){
			event.preventDefault();
			
			var url = "{{url('attachment')}}/"+attachmentId; 
			$.ajax({
				method: 'delete',
				url: url,
				data: {_token: token}
			}).done(function(msg){
				console.log(msg);
				location.reload();
			}).fail(function(msg){
				console.log(msg);
			});
		});
	
		function rating(rate){
			if($('#star'+rate).hasClass('icon-star-full2')){
				for(loop = 5; loop > rate; loop--){
					$('#star'+loop).removeClass('icon-star-full2');
					$('#star'+loop).addClass('icon-star-empty3');
				}
			}else{
				for(loop = 1; loop <= rate; loop++){
					$('#star'+loop).addClass('icon-star-full2');
					$('#star'+loop).removeClass('icon-star-empty3');
				}
			}
			$('.selected_rate_input').val(rate);
			$('.selected_rate').innerHTML(rate);
		}
</script>
@endsection