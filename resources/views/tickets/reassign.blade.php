@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Reassign Ticket</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Reassign Ticket</h6>
  </nav>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Tickets</h5>
                <p class="text-sm mb-0">
                 Reassign Ticket
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <!-- add new button -->
              </div>
            </div>
        </div>

        <div class="card-body">
          <div class="row border-bottom">
            <div class="col-md-12">
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
          </div>

          <div class="row border-bottom">
            <div class="col-md-12 mt-4">
              <form action="{{ route('tickets.assignto') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                <div class="row">
                    <div class="form-group col-md-5 @error('assign_to') is-invalid @enderror">
                      <label for="assign_to" class="form-control-label">Assign to</label>
                    <select class="form-control" name="assign_to" id="assign_to" >
                        @foreach($users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <button type="submit" class="btn btn-primary w-50 mt-4 ">Reassign Ticket</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          
      </div>

    </div>
  </div>
</div>




@endsection

@section('style')

  <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap.css" rel="stylesheet" />

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