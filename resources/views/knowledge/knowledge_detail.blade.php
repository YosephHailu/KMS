@extends('layouts.app')


@section('breadcrumb')
<a href="{{url('knowledge')}}" class="breadcrumb-item"> Knowledge Product</a>
<span class="breadcrumb-item active">{{$knowledge->title}}</span>
@endsection

@section('content')

<!-- Page content -->
<div class="page-content">
	<!-- Side Bar -->

	<!-- Main content -->
	<div class="content mt-2">
		<div class="row">
			<div class="col-lg-8">
				<div
					class="card card-body {{$knowledge->accessLevel->level_number >= 2?'bg-danger-700': $knowledge->accessLevel->level_number >= 1?'bg-warning-700':''}}">
					<div class="media">
						<div class="">
							<h6 class="media-title">
								<a href="#" class="font-weight-semibold">{{$knowledge->title}}</a>
								<span
									class="text-muted text-sm text-right float-right ml-3">{{\Carbon\Carbon::parse($knowledge->created_at)->format('d, M, Y')}}</span>
								@if(Auth::check())
								<a href="#" class="float-right" data-toggle="modal" data-target="#modal_rate">Rate</a>
								@endif
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
									&nbsp; {{$knowledge->knowledgeRating->count()}} {{__('search.ratting')}}
								</li>
								<li class="list-inline-item"><span class="text-blue">{{__('search.views')}} :</span>
									{{number_format($knowledge->views)}}
								</li>

							</ul>

							<ul class="list-inline list-inline-dotted  mb-2">
								<li class="list-inline-item text-primary">{{__('search.source')}} : <span
										class="text-muted">{{$knowledge->source}}</span></li>
								<li class="list-inline-item text-primary">{{__('search.contact')}} : <span
										class="text-muted">{{$knowledge->contact}}</span></li>
								<li class="list-inline-item text-primary">{{__('search.directorate')}} : <span
										class="text-muted">{{$knowledge->directorate->name}}</span></li>
								@if(Auth::check() && Auth::user()->can('publish', $knowledge))
								<li class="list-inline-item text-white"> :
									<a href="{{url('updateStatus/'.$knowledge->id)}}"
										class="btn btn-{{$knowledge->approved?"danger":"dark"}}">{{$knowledge->approved?"Undo publish":"Publish"}}</a>
								</li>
								@endif
							</ul>

							<div class="font-size-large">
								{{$knowledge->knowledge_description}}
							</div>
						</div>
					</div>
				</div>

				@if($knowledge->project != null)
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">{{__('search.project_information')}}</h5>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="text-primary" style="width:30%">{{__('search.project_status')}}</td>
									<td class="text-muted">{{$knowledge->project->projectStatus->status}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">{{__('search.project_category')}}</td>
									<td class="text-muted">{{$knowledge->project->projectCategory->category}}</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_starting_end')}}</td>
									<td class="text-muted">
										{{\Carbon\Carbon::parse($knowledge->project->starting_date)->format('d, M, Y')}}
										--/--
										{{\Carbon\Carbon::parse($knowledge->project->end_date)->format('d, M, Y')}}</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_contract')}}</td>
									<td class="text-muted">{{$knowledge->project->contract_no}}</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_manager')}}</td>
									<td class="text-muted">{{$knowledge->project->manager}}</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_finance_source')}}</td>
									<td class="text-muted">
										@foreach ($knowledge->project->projectFinance as $projectFinance)
										<span class="btn p-1 btn-primary">
											<h6 class="p-0 m-0">{{$projectFinance->finance->donner_name}}</h6
												class="p-0 m-0">
											{{number_format($projectFinance->budget)}} {{$projectFinance->unit->name}}
										</span>
										@endforeach
									</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_budget')}}</td>
									<td class="text-muted">{{number_format($knowledge->project->budget)}}</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_description')}}</td>
									<td class="text-muted">{{$knowledge->project->project_description}}</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_outcome')}}</td>
									<td class="text-muted">{{$knowledge->project->outcome}}</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_output')}}</td>
									<td class="text-muted">{{$knowledge->project->output}}</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_beneficiary_regions')}}</td>
									<td class="text-muted">
										@foreach (explode(',', $knowledge->project->beneficiaries_region) as $word)
										<span class="btn p-1 btn-primary"> {{$word}}</span>
										@endforeach
									</td>
								</tr>
								<tr>
									<td class="text-primary">{{__('search.project_beneficiary_weredas')}}</td>
									<td class="">
										@foreach (explode(',', $knowledge->project->wereda_kebele) as $word)
										<span class="btn p-1 btn-primary"> {{$word}}</span>
										@endforeach
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
									<td class="text-primary" style="width:30%">{{__('search.document_type')}}</td>
									<td class="text-muted">{{$knowledge->document->documentCategory->category}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">{{__('search.document_issued_date')}}
									</td>
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
									<td class="text-primary" style="width:30%">{{__('search.photographer')}}</td>
									<td class="text-muted">{{$knowledge->photo->photographer}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">{{__('search.event_date')}}</td>
									<td class="text-muted">{{$knowledge->photo->event_date}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				{{-- //photos --}}
				<div class="row">
					@foreach ($knowledge->photo->knowledgeProduct->attachments as $photoAttachment)
					<div class="col-sm-6 col-xl-4">
						<div class="card">
							<div class="card-img-actions mx-1 mt-1">
								<div class="card-img embed-responsive ">
									<img style="max-height: 200px"
										src="{{url('getAttachment/'.$photoAttachment->id)}}" />
								</div>
							</div>

							<div class="card-footer">
								<p>{{$photoAttachment->title}}</p>
								{{\Carbon\Carbon::parse($knowledge->photo->event_date)->format('D-M-Y')}}
								<div class="float-right">
									<a href="#" onclick="initializeDownload({{$photoAttachment->id}})"
										class="list-icons-item"><i class="icon-download top-0"></i></a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
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
									<td class="text-primary" style="width:30%">{{__('search.goal')}}</td>
									<td class="text-muted">{{$knowledge->video->goal}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">{{__('search.video_created_date')}}</td>
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
									<a href="#" onclick="initializeDownload({{$videoAttachment->id}})"
										class="list-icons-item"><i class="icon-download top-0"></i></a>
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
						<h5 class="card-title">{{__('search.map_information')}}</h5>
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
									<td class="text-primary" style="width:30%">{{__('search.map_type')}}</td>
									<td class="text-muted">{{$knowledge->map->mapType->type}}</td>
								</tr>
								<tr>
									<td class="text-primary" style="width:30%">{{__('search.map_created_date')}}</td>
									<td class="text-muted">{{$knowledge->map->created_date}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				@endif

				<div class="card">
					<div class="card-header header-elements-sm-inline">
						<h6 class="card-title font-weight-semibold link">
							{{number_format($knowledge->knowledgeComment->count())}} {{__('search.comments')}}</h6>
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
										@if (Auth::check() && $comment->user->id == Auth::Id())
										<a class="btn-delete-comment ml-2 mt-1" href="#" id="{{$comment->id}}">
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


				@if(Auth::check())
				<div class="card">
					<div class="card-header">
						<span class="text-muted"><span class="text-primary"> {{Auth::User()->name}}</span>
							{{__('search.comment_on_topic')}}</span>
					</div>
					<div class="card-body">
						{!! Form::open(['action' => ['KnowledgeCommentController@store'], 'method'=>
						'POST','enctype'=>'multipart/form-data']) !!}
						{{Form::textarea('message', "" ,['class'=>'form-control mb-3',"rows"=>"3", "cols"=>"1", "placeholder"=>"Enter your message..."])}}

						{{Form::hidden('knowledge_product_id',$knowledge->id)}}
						<div class="d-flex align-items-center">
							<button type="submit" class="btn bg-blue-400 btn-labeled btn-labeled-right ml-auto">
								<b><i class="icon-comment"></i></b> {{__('comment')}}</button>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
				@endif
			</div>

			<div class="col-lg-4">
				<div class="card card-body p-2 bg-blue m-0">
					<div class="media">
						<div class="media-body">
							<h6 class="media-title font-weight-semibold">{{__('documents')}} / {{__('attachments')}}
							</h6>
						</div>
					</div>
				</div>
				<div class="pt-0 row">
					@foreach ($knowledge->attachments->sortByDesc('created_at') as $attachment)

					<ul class="list-inline mb-0 col-sm-12 col-lg-12">
						<li class="list-inline-item col-12">
							<div class="card bg-light py-2 px-3 mt-3 mb-0 col-12">
								<div class="media my-1">
									<div class="mr-3 align-self-center"><i
											class="icon-file-pdf icon-2x text-danger-400 top-0"></i></div>
									<div class="media-body">
										<div class="font-weight-semibold">{{$attachment->title}}</div>

										<ul class="list-inline list-inline-condensed mb-0">
											<li class="list-inline-item text-muted">{{$attachment->downloads}}</li>
											<li class="list-inline-item"><a href="#" class="text-muted">Downloads</a>
											</li>
											<li class="list-inline-item"><a href="#"
													onclick="initializeDownload({{$attachment->id}})">Download</a></li>
											@can('delete', $knowledge)
											<li class="list-inline-item"><a
													href="{{url('attachment/'.$attachment->id)}}"
													class="btn-delete-attachment text-danger"
													id="{{$attachment->id}}">Delete</a>
											</li>
											@endcan
										</ul>
									</div>
								</div>
							</div>
						</li>
					</ul>
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
				<h5 class="modal-title">Delete Attachment</h5>
			</div>
			<div class="modal-body">
				<p>Press Continue To Delete Attachment</p>
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
				<h5 class="modal-title">{{__('search.rate_knowledge')}}</h5>
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

<script>
	var commentId = 0;
		var attachmentId = 0;
		var token = '{{Session::token()}}';
		var attachment_url = "{{url('attachment')}}";

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

		function initializeDownload(id){
			event.preventDefault();
			var url = "{{url('initializeAttachmentDownload')}}/"+id; 
			$.ajax({
				method: 'get',
				url: url,
				data: {_token: token}
			}).done(function(msg){
				console.log(msg.downloadable);
				if(msg.downloadable){
					window.location.replace(attachment_url+'/'+id);
				}
				// location.reload();
			}).fail(function(msg){
				console.log(msg);
			});
		}
</script>
@endsection