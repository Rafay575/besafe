@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Create Tickets</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Create New Tickets</h6>
  </nav>
@endsection

@section('content')
<div class="row">
  <div class="col-12 mx-auto">
    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">

                  <div class="form-group col-md-4 @error('tickettype_id') is-invalid @enderror">
                    <label for="tickettype_id" class="form-control-label">Ticket Type</label>
                  <select class="form-control" name="tickettype_id" id="tickettype_id" >
                      @foreach($tickettypes as $tickettype)
                        <option value="{{$tickettype->id}}">{{$tickettype->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-4 @error('ticketsubtype_id') is-invalid @enderror">
                    <label for="ticketsubtype_id" class="form-control-label">Ticket Sub Type</label>
                  <select class="form-control" name="ticketsubtype_id" id="ticketsubtype_id" >
                      @foreach($ticketsubtypes as $ticketsubtype)
                        <option value="{{$ticketsubtype->id}}">{{$ticketsubtype->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-4 @error('ticket_attachment') is-invalid @enderror">
                    <label for="ticket_attachment">Attachment</label>
                    <input type="file" name="ticket_attachment" class="form-control" id="ticket_attachment">
                    @error('ticket_attachment')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="name">Description</label>
                    <textarea  name="description" class="form-control" id="description"></textarea>
                  </div>


                  <div class="form-group col-md-4">
                      <button type="submit" class="btn btn-primary w-50 mt-4 ">Create Ticket</button>
                  </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection


@section('script') 

    <script type="text/javascript">
        document.getElementById("mobile").addEventListener("input", function() {
            var inputValue = this.value;
            console.log(inputValue);
            if (inputValue === "" || inputValue < 923) {
                this.value = "923";
            }
            if (inputValue.length > 12) {
                this.value = inputValue.slice(0, 12);
            }
        });
    </script>

<!--   <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script> -->

@endsection