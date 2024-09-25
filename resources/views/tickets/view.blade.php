@extends('layouts.main')

@section('breadcrumb')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
		<li class="breadcrumb-item text-sm">
			<a class="text-white" href="javascript:;">
				<i class="ni ni-box-2"></i>
			</a>
		</li>
		<li class="breadcrumb-item text-sm text-white active">
			<a class="opacity-5 text-white" href="javascript:;">View Ticket</a>
		</li>
	</ol>
	<h6 class="font-weight-bolder mb-0 text-white">View Ticket</h6>
</nav>
@endsection

@section('content')
<div class="row">

	<div class="{{ auth()->user()->id == $ticket->assigned_to ? 'col-md-7' : 'col-md-9' }}  px-2 ">
		@if ($ticket->feedback()->count() > 0)
				<div class="h-100" id="other-section" style="display: block;">
					<div class=" p-4 bg-white-unique lightborder-unique h-100">
						@php
							$rating = $ticket->feedback()->first()->rate;
							$review = $ticket->feedback()->first()->review;
							$created_at = $ticket->feedback()->first()->created_at->format('D, M d, Y h:i A');
						@endphp
						<div class=" d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center justify-content-between w-100">
								<div class="d-flex">
									<h6 class="mb-0"><strong>{{$requested_byName->name}}</strong> gave you a {{$rating}}-star
										review</h6>
									<i class="text-muted" style="margin-left:10px;">{{$created_at}}</i>
								</div>
								<div>
									<button type="button" class="btn-unique btn-unique-outline-success me-2"
										onclick="toggleSections()">Conversation</button>
								</div>

							</div>
						</div>

						<div class="card mt-4 lightborder-unique">
							<div class="mb-4">
								<div class="card-header lightborder-unique bg-light px-4 py-1">

									<h6 class="my-2">{{$requested_byName->name}} REVIEW</h6>
								</div>
								<div class="d-flex align-items-start mb-2 card-body">
									<div>
									@if ($requested_byName->image)
											<img src="{{ asset('images/profile/' . $requested_byName->image) }}" height="70"
												class="rounded-circle " alt="Avatar">
										@else
											<div class="bg-light p-4  rounded-circle d-flex justify-content-center align-items-center"
												style="height: 60px; width: 60px;">
												<i class="fas fa-user" style="font-size:24px"></i>
											</div>
										@endif
									</div>
									<div class="ms-4">

										<strong>{{$requested_byName->name}} message
											<span class="text-warning ms-2">
												@for ($i = 1; $i <= $rating; $i++)
													&#9733;
												@endfor
											</span>
											<strong class="ms-2">{{$rating}}</strong></strong>

										<p style="font-size:12px;margin-top:5px">{{$review}}</p>
									</div>
								</div>
							</div>


						</div>
					</div>
				</div>
		@endif

		<div id="rafay-section-1" style="display:{{ $ticket->feedback()->count() > 0 ? 'none' : 'block' }}">
			<div class="bg-white-unique pt-3 h-100 d-flex flex-column  lightborder-unique">

				<div class="d-flex px-3 pb-3 justify-content-between align-items-center border-bottom ">
					<h5 class="mb-0 ">Ticket View</h5>
					@if($ticket->status == "Open")
						<div class="d-flex">
							<button type="button" class="btn-unique btn-unique-outline-success me-2"
								onclick="toggleCommentForm()">Reply</button>
							@if(auth()->user()->id == $ticket->assigned_to)

								<button type="button" class=" btn-unique btn-unique-outline-danger me-2" data-bs-toggle="modal"
									data-bs-target="#feedbackModal">
									Close</button>
								<a href="{{route('tickets.reassign', $ticket->id)}}" class="mx-2" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Reasign ticket" data-container="body" data-animation="true"
									data-bs-original-title="Reasign ticket">
									<button type="button" class="btn-unique btn-unique-outline-purple me-2">Reassign</button>
								</a>
							@endif
						</div>
					@else
						<button type="button" class="btn-unique btn-unique-outline-success me-2"
							onclick="toggleSections()">Feedback</button>
					@endif
				</div>
				<div class="card-body px-0 pt-0 overflow-auto flex-grow-1" style="height:60vh">
					@if ($ticket->comments->count() > 0)
						@foreach($ticket->comments->reverse() as $comment)
							<div class="  mb-5">
								<div class="">
									<div class="d-flex align-items-center border-bottom py-3 px-3 bg-light">
										@if ($comment->commenter_user->image)
											<img src="{{ asset('images/profile/' . $comment->commenter_user->image) }}" height="50"
												class="rounded-circle me-2" alt="Avatar">
										@else
											<div class="bg-white p-4 me-2 rounded-circle d-flex justify-content-center align-items-center"
												style="height: 30px; width: 30px;">
												<i class="fas fa-user" style="font-size:20px"></i>
											</div>
										@endif
										<div>
											<strong>{{$comment->commenter_user->name}}</strong>
											<small class="text-muted d-block">
												{{$comment->created_at->format('D, M d, Y h:i A') }}
											</small>
										</div>
									</div>
									<div class="comment-content mt-5 text-justify px-6"
										style="white-space: normal; word-wrap: break-word;">
										<p>{{$comment->description}}</p>
										@if($comment->comment_attachment)
											<div class="btn-group" role="group">
												<!-- Single button with two icons -->
												<button type="button"
													class="btn  btn-outline-primary primary-unique d-flex justify-content-between align-items-center">
													Document Attachment
													<!-- View icon -->
													<a href="{{ route('comment.attachment.view', $comment->id) }}" target="_blank"
														class="ms-2" title="View">
														<i class="fa fa-eye text-white" aria-hidden="true"></i>
													</a>
													<!-- Download icon -->
													<a href="{{ route('comment.attachment.download', $comment->id) }}" class="ms-2"
														title="Download">
														<i class="fa fa-download text-white" aria-hidden="true"></i>
													</a>
												</button>
											</div>
										@endif
										@if($comment->voice_note_path)
											<div class="mt-3">

												<audio controls>
													<source
														src="{{ asset('comment_attachment/audios/' . $comment->voice_note_path) }}"
														type="audio/mpeg">
													Your browser does not support the audio element.
												</audio>
											</div>
										@endif
									</div>
								</div>
							</div>
						@endforeach
					@else
						<div class="h-100 d-flex justify-content-center align-items-center ">
							No comment found
						</div>
					@endif
				</div>

				@if($ticket->status == "Open")
					<div class="border-top p-3 d-none w-100" id="commentForm">
						<form action="{{ route('comment.add') }}" method="POST" enctype="multipart/form-data" class="w-100">
							@csrf
							<input type="hidden" name="ticket_id" value="{{$ticket->id}}">
							<input type="hidden" name="commenter" value="{{auth()->user()->id}}">
							<div class="form-group mb-3">
								<label for="description" class="form-label"><strong>Write a Comment</strong></label>
								<textarea id="description" name="description" class="form-control bg-light" rows="4"
									placeholder="Type your message here..."></textarea>
							</div>

							<div class="form-group mb-3 d-flex">

								<div class="d-flex align-items-center" style="width:fit-content">
									<input type="file" name="comment_attachment" class="d-none" id="comment_attachment"
										onchange="handleFileUpload()">
									<button class="upload-button" type="button" id="uploadButton"
										onclick="document.getElementById('comment_attachment').click();">
										<div class="circle1" data-bs-toggle="tooltip" data-bs-placement="top"
											title="Upload file">
											<i class="fas fa-paperclip"></i>
										</div>
									</button>
								</div>
								<div class="mic-container">
									<input type="hidden" name="voice_note" id="voiceNoteInput">
									<div id="recordButton" class="circle" data-bs-toggle="tooltip" data-bs-placement="top"
										title="Voice Message">
										<i id="recordIcon" class="fas fa-microphone"></i>
									</div>
									<div id="timer" style="font-size: 14px; margin-left: 20px; color: #333; display: none;">
										00:00</div>
								</div>
							</div>
							<div class="d-flex align-items-center justify-content-left mb-4 ">
								<div class="file-upload-container position-relative">
									<div class="file-preview" id="filePreview" style="display: none;">
										<i class="fas fa-file-alt"></i>
										<div class="progress-bar" id="progressBar"></div>
									</div>
									<div class="remove-file" id="removeFileBtn" style="display:none;">&times;</div>
								</div>
								<div class="voice-upload-container">
									<div class="voice-preview" id="voicepreview" style="display: none;">
										<i class="fas fa-microphone"></i>
										<div class="timmer-recorded" id="recordedTime">00:00</div>
										<audio id="audioPlayback" controls style="display:none;"></audio>
									</div>
									<div class="remove-voice" id="removeVoiceBtn" style="display:none">&times;</div>
								</div>
							</div>
							<div>
								<button type="submit" class="btn btn-primary primary-unique mb-0">Send</button>
							</div>
						</form>
					</div>
				@endif
			</div>
		</div>

	</div>



	<div class="col-md-3 px-2 ">
		<div class="bg-white-unique p-3  d-flex flex-column lightborder-unique">
			<h5 class="text-dark">{{$ticket->tickettype->name}}</h5>
			<h6 class="text-dark" style="font-size:14px">{{$ticket->ticketsubtype->name}}</h6>
			<!-- <p class="text-muted" style="font-size:14px">Resolution due by Tue, Aug 27, 2024, 5:30 AM</p> -->

			<div class="form-group mb-3">
				<label for="reference" class="form-label" style="font-size:12px">Ticket Number</label>
				<div class="form-control-static border p-2 rounded" style="background-color: #f8f9fa;font-size:12px">
					{{$ticket->id}}
				</div>
			</div>

			<div class="form-group mb-3">
				<label for="status" class="form-label" style="font-size:12px">Status</label>
				<div class="form-control-static border p-2 rounded" style="background-color: #f8f9fa;font-size:12px">
					{{$ticket->status}}
				</div>
			</div>

			<div class="form-group mb-3">
				<label for="priority" class="form-label" style="font-size:12px">Priority</label>
				<div class="form-control-static border p-2 rounded" style="background-color: #f8f9fa;font-size:12px">
					{{ $priority }}
				</div>
			</div>

			<div class="form-group mb-3">
				<label for="group" class="form-label" style="font-size:12px">Escalations</label>
				<div class="form-control-static border p-2 rounded" style="background-color: #f8f9fa;font-size:12px">
					{{$ticket->current_level}}
				</div>
			</div>

			<div class="form-group mb-3">
				<label for="agent" class="form-label" style="font-size:12px">Assigned to</label>
				<div class="form-control-static border p-2 rounded" style="background-color: #f8f9fa;font-size:12px">
					{{$assignedUserName->name}}
				</div>
			</div>

		</div>
	</div>
	@if(auth()->user()->id == $ticket->assigned_to)
		<div class="col-md-2 px-2">
			<div class="bg-white-unique p-3 d-flex flex-column lightborder-unique">
				<h6>Contact Details</h6>
				<div class="d-flex align-items-center flex-column  my-3 justify-content-center">

					@if ($requested_byName->image)
						<div>
							<img src="{{ asset('images/profile/' . $requested_byName->image) }}" class="rounded-circle me-2"
								style="width:130px" alt="Avatar">
						</div>
					@else
						<div class="relative rounded-circle bg-light d-flex align-items-center justify-content-center"
							style="width: 80px;height:80px ">
							<i class="fa fa-user fa-rounded" style="font-size: 45px; color: black;"></i>
						</div>
					@endif
					<h5 class="mb-0 mt-2" style="color: #000; font-weight: 700;font-size:14px">{{$requested_byName->name}}
					</h5>
					<small class="text-muted" style="font-size:12px">{{$designationName}}</small>
					<div>
					</div>
					</>
					<div class="border-top pt-2">
						<p class="mb-1 text-muted" style="font-size: 10px;">
							<i class="fa fa-id-card" aria-hidden="true" style="min-width:15px"></i>
							{{$requested_byName->id}}
						</p>
						<p class="mb-1 text-muted" style="font-size: 10px;">
							<i class="fa fa-envelope " aria-hidden="true" style="min-width:15px"></i>
							{{$requested_byName->email}}
						</p>
						<p class="mb-1 text-muted" style="font-size: 10px;">
							<i class="fa fa-phone " aria-hidden="true" style="min-width:15px"></i>
							+{{$requested_byName->mobile}}
						</p>
						<p class="mb-1 text-muted" style="font-size: 10px;">
							<i class="fa fa-building " aria-hidden="true" style="min-width:15px"></i> Department:
							{{$departmentName}}
						</p>

						<p class="mb-1 text-muted" style="font-size: 10px;">
							<i class="fa fa-map-marker " aria-hidden="true" style="min-width:15px"></i> Region:
							{{$regionName}}
						</p>
						<p class="mb-1 text-muted" style="font-size: 10px;">
							<i class="fa fa-map-marker-alt " aria-hidden="true" style="min-width:15px"></i> Subregion:
							{{$subregionName}}
						</p>
					</div>
				</div>
			</div>
	@endif
	</div>

	<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="feedbackModalLabel">Provide Answer</h5>
				</div>
				<div class="modal-body">
					<form action="{{ route('ticket.close', $ticket->id) }}" method="post">
						@csrf
						<input type="hidden" name="ticket_id" value="{{$ticket->id}}">
						<input type="hidden" name="commenter" value="{{auth()->user()->id}}">
						<div class="form-group">
							<label for="feedback" class="col-form-label">How you resolve the ticket?</label>
							<textarea class="form-control" id="feedback" name="description" rows="4"
								placeholder="Enter your feedback..." required></textarea>
						</div>
						<div class="d-flex align-items-center justify-content-between ">
							<div class="d-flex justify-content-between align-items-center ">
								<div class="input-group">
									<input type="file" name="comment_attachment" class="d-none" id="commentattachment"
										onchange="displayFileName1()">

									<button class="bg-transparent" type="button" id="uploadButton"
										style="border:none;outline:none"
										onclick="document.getElementById('commentattachment').click();">
										<i class="fas fa-paperclip"></i>
									</button>
								</div>
								<label class="form-label mb-0" id="file-name-1" style="min-width:100px">Attach a
									file</label>
							</div>
							<div>
								<button type="submit" class="btn btn-primary primary-unique mb-0">Send</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	@if($ticket->status == "Closed" && !$ticket_feedback_exists && auth()->user()->id == $ticket->requested_by)
		<div class="modal fade show" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel"
			aria-hidden="true" style="display: block;height:100vh;width:100vw;background-color: rgba(0, 0, 0, 0.5);
																																																								  backdrop-filter: blur(1px);;z-index:9999">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="mx-auto"> {{$assignedUserName->name}} has closed this ticket</h5>
					</div>

					<div class="modal-body">
						<div>
							@if($ticket->comments->isNotEmpty())
												@php
													$lastComment = $ticket->comments->last();
												@endphp
												<div class="py-3 border-bottom">
													<div class="d-flex align-items-center border-bottom pb-3">
														<img src="https://via.placeholder.com/50" class="rounded-circle me-2" alt="Avatar">
														<div>
															<strong>{{ $lastComment->commenter_user->name }}</strong>
															<small class="text-muted d-block">
																{{ $lastComment->created_at->format('D, M d, Y h:i A') }}
															</small>
														</div>
													</div>

													<div class="comment-content mt-5 text-justify"
														style="white-space: normal; word-wrap: break-word;">
														<p>{{ $lastComment->description }}</p>
													</div>

													@if($comment->comment_attachment)
														<div class="btn-group" role="group">
															<!-- Single button with two icons -->
															<button type="button"
																class="btn  btn-outline-primary primary-unique d-flex justify-content-between align-items-center">
																Document Attachment
																<!-- View icon -->
																<a href="{{ route('comment.attachment.view', $comment->id) }}" target="_blank"
																	class="ms-2" title="View">
																	<i class="fa fa-eye text-white" aria-hidden="true"></i>
																</a>
																<!-- Download icon -->
																<a href="{{ route('comment.attachment.download', $comment->id) }}" class="ms-2"
																	title="Download">
																	<i class="fa fa-download text-white" aria-hidden="true"></i>
																</a>
															</button>
														</div>
													@endif
												</div>
							@else
								<p>No comments available.</p>
							@endif
						</div>
						<form action="{{ route('feedback.add') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="ticket_id" value="{{$ticket->id}}">
							<input type="hidden" name="reviewer" value="{{auth()->user()->id}}">
							<div class="form-group">
								<label for="feedback" class="col-form-label">Feedback
								</label>
								<textarea class="form-control" id="feedback" name="review" rows="4"
									placeholder="Enter your feedback..." required></textarea>
							</div>

							<p class="col-form-label pb-0">Rating</p>
							<div class="form-group  pt-0" style="margin-bottom:75px">
								<div class="rate">
									<input type="radio" id="star5" name="rate" value="5" required />
									<label for="star5" title="5 stars">5 stars</label>
									<input type="radio" id="star4" name="rate" value="4" />
									<label for="star4" title="4 stars">4 stars</label>
									<input type="radio" id="star3" name="rate" value="3" />
									<label for="star3" title="3 stars">3 stars</label>
									<input type="radio" id="star2" name="rate" value="2" />
									<label for="star2" title="2 stars">2 stars</label>
									<input type="radio" id="star1" name="rate" value="1" />
									<label for="star1" title="1 star">1 star</label>
								</div>
							</div>


							<div class="form-group mt-4">
								<button type="submit" class="btn btn-sm btn-outline-primary primary-unique  w-100 ">Add
									Feedback</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	@endif


	@endsection
	@section('script')
	<script src="{{ asset('assets/js/ticketview.js') }}"></script>
	@endsection