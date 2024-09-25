@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Edit Ticket Setting</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Edit Ticket Setting</h6>
  </nav>
@endsection

@section('content')
<div class="row">
  <div class="col-12 mx-auto">
      <form action="{{ route('ticketsetting.update',$ticketsetting->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="put">
         <div class="row">
          <div class="col-12">
            <div class="card bg-white-custom lightborder-unique shadow-lg">
                  <div class="card-body">
                    <div class="row">

                      <div class="form-group col-md-6 @error('ticket_type_id') is-invalid @enderror">
                      <label for="ticket_type_id" class="form-control-label">Ticket Type</label>
                        <select class="form-control" name="ticket_type_id" id="ticket_type_id" >
                          @foreach($tickettypes as $tickettype)
                            <option {{$ticketsetting->ticket_type_id == $tickettype->id ? "selected" : ""}} value="{{$tickettype->id}}">{{$tickettype->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-6 @error('ticket_sub_type_id') is-invalid @enderror">
                        <label for="ticket_sub_type_id" class="form-control-label">Sub Type</label>
                        <select class="form-control" name="ticket_sub_type_id" id="ticket_sub_type_id" >
                          @foreach($ticketsubtypes as $ticketsubtype)
                            <option {{$ticketsetting->ticket_sub_type_id == $ticketsubtype->id ? "selected" : ""}} value="{{$ticketsubtype->id}}">{{$ticketsubtype->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="col-12">
                        <table class="table table-striped" id="ticketsettingtable">
                          <thead>
                            <tr>
                              <th scope="col">Escalation </th>
                              <th scope="col">Escalation Days</th>
                              <th scope="col"><a href="#" onclick="addEscalation()"><i class="fa fa-plus" aria-hidden="true"></i> Add Row</a></th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach($ticketsetting->escalations as $escalation)

                            <tr>
                            <td>Escalation {{$escalation->level}}</td>
                            <td><input type="number" name="escalation[{{$escalation->level}}][days]" value="{{$escalation->days}}" class="form-control" id="days" placeholder="Days"></td>
                            <td><a href="#" class="removeEscalation"><i class="fas fa-trash text-danger"></i></a></td>
                            </tr>

                          @endforeach
                            
                          </tbody>
                        </table>
                      </div>

                      <div class="form-group col-md-3">
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary w-100 mt-4 ">Update</button>
                        </div>
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
    
     $("#ticketsettingtable").on('click','.removeEscalation',function(){
         $(this).closest('tr').remove();
      });

    function addEscalation() {
      var number = +sessionStorage.getItem("eNum");
      var number = number +=1;
      sessionStorage.setItem("eNum", number);
      var html = '';
          html += '<tr>';
          html += '<td>Escalation '+number+'</td>';
          html += '<td><input type="number" name="escalation['+number+'][days]" class="form-control" id="days" placeholder="Days"></td>';
          html += '<td><a href="#" class="removeEscalation"><i class="fas fa-trash text-danger"></i></a></td>';
          html += '</tr>';

      $("#ticketsettingtable").find('tbody').append(html);
    }

    $( document ).ready(function() {
      sessionStorage.removeItem('eNum');
      sessionStorage.setItem("eNum", {{$ticketsetting->escalations->count()}});
      // addEscalation();
    });

  </script>

@endsection