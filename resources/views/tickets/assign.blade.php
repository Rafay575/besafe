@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Assigned Tickets List</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Assigned Tickets List</h6>
  </nav>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card bg-white-custom lightborder-unique shadow-lg">

        <div class="card-header bg-white-custom pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Tickets</h5>
                <p class="text-sm mb-0">
                 List of Assigned Tickets
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <!-- add new button -->
              </div>
            </div>
        </div>

        <div class="table-responsive"style="border-collapse: collapse; border-spacing: 0; width: 95%; margin-left: 2%;">
          <table class="table table-flush dataTable no-footer table-striped" id="tickets-table">
            <thead class="thead-light">
              <tr>
                <th>Ticket Type</th>
                <th>Total Comments</th>
                <th>Requested By</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($tickets as $ticket)
              <tr>
                <td>
                    <div class="d-flex align-items-center">
                      {{$ticket->tickettype->name}}
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      {{$ticket->comments->count()}}
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      {{$ticket->requestedby->name}}
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      {{$ticket->status}}
                    </div>
                </td>
           
                <td>
                   <div style="width: 45%;">
                     
                    <a 
                        href="{{route('ticket.view', ['id' => $ticket->id])}}" 
                        class="mx-2" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="view ticket" 
                        data-container="body" 
                        data-animation="true" 
                        data-bs-original-title="view ticket"
                      >
                      <i class="fas fa-eye text-primary"></i>
                    </a>

                    @if($ticket->status == "Open")
                      @if($ticket->tickettype->name == "HRPSP POC")
                        @if($ticket->current_level > 1)
                          <a 
                              href="{{route('tickets.reassign', $ticket->id)}}" 
                              class="mx-2" 
                              data-bs-toggle="tooltip" 
                              data-bs-placement="top" 
                              title="Reasign ticket" 
                              data-container="body" 
                              data-animation="true" 
                              data-bs-original-title="Reassign ticket"
                            >
                            <i class="fas fa-repeat text-primary"></i>
                          </a>
                        @endif
                      @else
                        <a 
                            href="{{route('tickets.reassign', $ticket->id)}}" 
                            class="mx-2" 
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            title="Reasign ticket" 
                            data-container="body" 
                            data-animation="true" 
                            data-bs-original-title="Reassign ticket"
                          >
                          <i class="fas fa-repeat text-primary"></i>
                        </a>
                      @endif
                    @endif

                   </div> 
                </td>

              @endforeach
            </tbody>
          </table>
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