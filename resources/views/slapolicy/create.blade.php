@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Set SLA Policy</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Set SLA Policy</h6>
  </nav>
@endsection

@section('content')
<div class="row ">
  <div class="col-12 mx-auto ">
    <form action="{{ route('slapolicies.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class=" bg-white-custom lightborder-unique shadow-lg">
            <div class="card-body ">
              <div class="row">

                <div class="form-group col-md-4">
                    <label for="businessName" class="form-label">Name *</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="e.g. Chicago Business Hours" required>
                </div>

                <div class="form-group col-md-8">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="e.g. This Business Calendar belongs to Chicago timezone">
                </div>

                <!-- SLA Target Section -->
                <h5 class="mt-4">Set SLA target as:</h5>
                <div class="table-responsive">
                    <table class="table align-middle table-striped">
                        <thead>
                            <tr>
                                <th>Priority</th>
                                <th>First response time</th>
                                <th>Resolution time</th>
                                <th>Operational hours</th>
                                <th>Escalation</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($priorities as $priority)

                            @php
                              if($priority->priority == "Urgent"){
                                $badge_class = "bg-danger";
                              } elseif($priority->priority == "High"){
                                $badge_class = "bg-warning";
                              } elseif($priority->priority == "Medium"){
                                $badge_class = "bg-info";
                              } elseif($priority->priority == "Low"){
                                $badge_class = "bg-success";
                              } else {
                                $badge_class = "";
                              }
                            @endphp
                            <tr>
                                <td><span class="badge {{$badge_class}}">{{$priority->priority}}</span></td>
                                <td><input type="text" name="{{strtolower($priority->priority)}}_first_response_time" class="form-control" placeholder="10m"></td>
                                <td><input type="text" name="{{strtolower($priority->priority)}}_resolution_time" class="form-control" placeholder="10m"></td>
                                <td>
                                    <select name="{{strtolower($priority->priority)}}_operational_hours" class="form-select">
                                        <option value="business_hours" selected>Business hours</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input name="{{strtolower($priority->priority)}}_escalation" value="off" type="hidden">
                                        <input name="{{strtolower($priority->priority)}}_escalation" class="form-check-input" type="checkbox" checked>
                                    </div>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  <div class="mt-4 d-flex">
                      <button type="submit" class="btn btn-primary me-2">Save</button>
                  </div>
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

  <script>
    $('.copy-to-all').click(function(){
      var start_time = document.querySelectorAll('input[name=monday_start]')[0].value;
      var end_time   = document.querySelectorAll('input[name=monday_end]')[0].value;

      document.querySelectorAll('input.day_start_time').forEach(function(input) {
          input.value = start_time;
      });

      document.querySelectorAll('input.day_end_time').forEach(function(input) {
          input.value = end_time;
      });

    });

  </script>

  <script>
    $('#24x7').click(function(){
      var element = document.getElementById("day-selector").classList.add("d-none");
      var element = document.getElementById("working-hours-day").classList.add("d-none");
    });

    $('#customBusinessHours').click(function(){
      var element = document.getElementById("day-selector").classList.remove("d-none");
      var element = document.getElementById("working-hours-day").classList.remove("d-none");
    });
  </script>

  <script>
      const checkboxes = document.querySelectorAll('.weekdays');
      const countDisplay = document.getElementById('checked-count');

      checkboxes.forEach(checkbox => {
          checkbox.addEventListener('click', () => {
              const checkedCount = document.querySelectorAll('.weekdays:checked').length;
              countDisplay.textContent = checkedCount;
          });
      });
  </script>


@endsection