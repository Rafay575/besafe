@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Feedback Ticket</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Feedback Ticket</h6>
  </nav>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Ticket Feedback</h5>
                <p class="text-sm mb-0">
                 Ticket Feedback
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <!-- add new button -->
              </div>
            </div>
        </div>

				<div class="card-body">
	        <div class="row border-bottom">
	        	<div class="col-md-8">
	        		<div class="row">
	        			<div class="col-md-12">
	        				<h4>Ticket Description</h4>
	        			</div>
	        		</div>
	        		<div class="row">
	        			<div class="col-md-12">
	        				{{$ticket->description}}
	        			</div>
	        		</div>
	        	</div>
	        	<div class="col-md-4 ">
	        		<div class="row">
	        			<div class="col-md-12 text-center">
	        				<h4>Status and Info</h4>
	        			</div>
	        		</div>
	        		<div class="row">
								<table class="table">
								  <tbody>
								    <tr>
								      <th>Ticket Type</th>
								      <td>{{$ticket->tickettype->name}}</td>
								    </tr>
								    <tr>
								      <th>Ticket Sub Type</th>
								      <td>{{$ticket->ticketsubtype->name}}</td>
								    </tr>
								    <tr>
								      <th>Ticket Creator</th>
								      <td>{{$ticket->requestedby->name}}</td>
								    </tr>
								    <tr>
								      <th>Status</th>
								      <td>{{$ticket->status}}</td>
								    </tr>
								    <tr>
								      <th>Ticket Created</th>
								      <td>{{$ticket->created_at}}</td>
								    </tr>
								    @if($ticket->ticket_attachment)
									    <tr>
									      <th>Ticket Attachment</th>
									      <td><a href="{{route('ticket.attachment.download', $ticket->id)}}" target="_blank" >Download file</a></td>
									    </tr>
								    @endif
								  </tbody>
								</table>
	        		</div>
	        	</div>
	        </div>

	        @foreach($ticket->comments as $comment)
						<div class="row border-bottom pt-4 pb-4">
							<div class="col-md-8">
								<div class="row">
		        			<div class="col-md-12">
		        				{{$comment->description}}
		        			</div>
		        		</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<table class="table">
									  <tbody>
									    <tr>
									      <th>Commenter</th>
									      <td>{{$comment->commenter_user->name}}</td>
									    </tr>
									    <tr>
									      <th>Comment Added</th>
									      <td>{{$comment->created_at}}</td>
									    </tr>
									    @if($comment->comment_attachment)
										    <tr>
										      <th>Comment Attachment</th>
										      <td><a href="{{route('comment.attachment.download', $comment->id)}}" target="_blank" >Download file</a></td>
										    </tr>
									    @endif
									  </tbody>
									</table>
		        		</div>
		        	</div>
						</div>
					@endforeach

					@if($ticket->status == "Closed" && $ticket->requested_by == auth()->user()->id)

						@if($ticket->feedback()->count() > 0)
							<div class="row border-bottom pt-4 pb-4">
								<div class="col-md-12">
	        				<h5>Ticket Feedback</h5>
	        			</div>
								<div class="col-md-8">
									<div class="row">
			        			<div class="col-md-12">
			        				{{$ticket->feedback()->first()->review}}
			        			</div>
			        		</div>
								</div>
								<div class="col-md-4">
									<div class="rate">
								    <input type="radio" id="star5" name="rate" value="5" disabled {{$ticket->feedback()->first()->rate == 5 ? "checked" : ""}} />
								    <label for="star5" title="5 Star">5 stars</label>
								    <input type="radio" id="star4" name="rate" value="4" disabled {{$ticket->feedback()->first()->rate == 4 ? "checked" : ""}} />
								    <label for="star4" title="4 Star">4 stars</label>
								    <input type="radio" id="star3" name="rate" value="3" disabled {{$ticket->feedback()->first()->rate == 3 ? "checked" : ""}} />
								    <label for="star3" title="3 Star">3 stars</label>
								    <input type="radio" id="star2" name="rate" value="2" disabled {{$ticket->feedback()->first()->rate == 2 ? "checked" : ""}} />
								    <label for="star2" title="2 Star">2 stars</label>
								    <input type="radio" id="star1" name="rate" value="1" disabled {{$ticket->feedback()->first()->rate == 1 ? "checked" : ""}} />
								    <label for="star1" title="1 Star">1 star</label>
									</div>
			        	</div>
							</div>
						@else
							<div class="row border-bottom">
								<form action="{{ route('feedback.add') }}" method="POST" enctype="multipart/form-data">
			      			@csrf
			      			<input type="hidden" name="ticket_id" value="{{$ticket->id}}">
			      			<input type="hidden" name="reviewer" value="{{auth()->user()->id}}">
			      			<div class="row pt-4">

					            <div class="form-group col-md-8">
					              <label for="name">Feedback Description</label>
					              <textarea  name="review" class="form-control" id="description"></textarea>
					            </div>

					            <div class="form-group col-md-4">
												<div class="rate">
											    <input type="radio" id="star5" name="rate" value="5" />
											    <label for="star5" title="text">5 stars</label>
											    <input type="radio" id="star4" name="rate" value="4" />
											    <label for="star4" title="text">4 stars</label>
											    <input type="radio" id="star3" name="rate" value="3" />
											    <label for="star3" title="text">3 stars</label>
											    <input type="radio" id="star2" name="rate" value="2" />
											    <label for="star2" title="text">2 stars</label>
											    <input type="radio" id="star1" name="rate" value="1" />
											    <label for="star1" title="text">1 star</label>
												</div>
					            </div>

					            <div class="form-group col-md-2">
					                <button type="submit" class="btn btn-primary w-100 ">Add Feedback</button>
					            </div>

					        </div>
		            </form>
							</div>
						@endif

					@endif
	    </div>

    </div>
  </div>
</div>




@endsection

@section('style')

	<style type="text/css">
		*{
		    margin: 0;
		    padding: 0;
		}
		.rate {
		    float: left;
		    height: 46px;
		    padding: 0 10px;
		}
		.rate:not(:checked) > input {
		    position:absolute;
		    top:-9999px;
		}
		.rate:not(:checked) > label {
		    float:right;
		    width:1em;
		    overflow:hidden;
		    white-space:nowrap;
		    cursor:pointer;
		    font-size:30px;
		    color:#ccc;
		}
		.rate:not(:checked) > label:before {
		    content: '★ ';
		}
		.rate > input:checked ~ label {
		    color: #ffc700;    
		}
		.rate:not(:checked) > label:hover,
		.rate:not(:checked) > label:hover ~ label {
		    color: #deb217;  
		}
		.rate > input:checked + label:hover,
		.rate > input:checked + label:hover ~ label,
		.rate > input:checked ~ label:hover,
		.rate > input:checked ~ label:hover ~ label,
		.rate > label:hover ~ input:checked ~ label {
		    color: #c59b08;
		}

	</style>

@endsection


@section('script')

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap.js"></script>

<script>

    $( document ).ready(function() {
        new DataTable('#tickets-table');
    });


 </script>

@endsection