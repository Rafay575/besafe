@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="View Near Miss">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('near-miss.index')}}">List of Near Misses</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="View Near Miss" page-desc="View Near Miss Details">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
    <x-slot:pageHeader>
      <div class="ms-auto my-auto mt-lg-0 mt-4">
        <div class="ms-auto my-auto">
          {{-- <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#recordCreate">+&nbsp; Add</a> --}}
        </div>
      </div>
    </x-slot>
    {{-- x slot page header ends here --}}

    {{-- default slot start here --}}
  <div class="row container">
      {{-- right side --}}
    <div class="table-responsive col-8">
        <table class="table align-items-center mb-0 table-bordered col-12">

            <tbody>
                <tr>
                  <th>Date</th>
                  <td>{{ formatDate($near_miss->date) }}</td>
                </tr>
                <tr>
                  <th>Time</th>
                  <td>{{ $near_miss->time }}</td>
                </tr>
                <tr>
                  <th>Initiated By</th>
                  <td>{{ $near_miss->initiator->first_name }}</td>
                </tr>
                <tr>
                  <th>Location</th>
                  <td>{{ $near_miss->meta_location ? $near_miss->meta_location->location_title : ''}}</td>
                </tr>
                <tr>
                  <th>Other Location</th>
                  <td>{{ $near_miss->other_location}}</td>
                </tr>
                <tr>
                  <th>Line</th>
                  <td>{{ $near_miss->line}}</td>
                </tr>
                <tr>
                  <th>Witness Name</th>
                  <td>{{ $near_miss->witness_name}}</td>
                </tr>
                <tr>
                  <th>Initial Recommendation</th>
                  <td>{{ $near_miss->initial_recommendation}}</td>
                </tr>
                <tr>
                  <th>Person Involved</th>
                  <td>{{ $near_miss->person_involved }}</td>
                </tr>
                <tr>
                  <th>Department</th>
                  <td>{{ $near_miss->department ? $near_miss->department->department_title : '' }}</td>
                </tr>
                <tr>
                  <th>Unit</th>
                  <td>{{ $near_miss->unit ? $near_miss->unit->unit_title : '' }}</td>
                </tr>
                <tr>
                  <th>Near Miss Classification</th>
                  <td>{{ $near_miss->near_miss_class ? $near_miss->near_miss_class->class_title : '' }}</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>{{ $near_miss->description }}</td>
                </tr>
                <tr>
                  <th>Shift</th>
                  <td>{{ $near_miss->shift }}</td>
                </tr>
                <tr>
                  <th>Immediate Action</th>
                  <td>{{ $near_miss->immediate_action }}</td>
                </tr>
                <tr>
                  <th>Immediate Cause</th>
                  <td>{{ $near_miss->immediate_cause }}</td>
                </tr>
                <tr>
                  <th>Root Cause</th>
                  <td>{{ $near_miss->root_cause }}</td>
                </tr>
                <tr>
                  <th>Persons Involved List</th>
                  <td>
                      <table class="table text-xxs table-sm table-responsive table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th>Sno</th> --}}
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Health Status</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                              @if (!empty($near_miss->persons))                                  
                                @foreach ($near_miss->persons as $person)
                                <tr>
                                    {{-- <td>{{$action['sno']}}</td> --}}
                                    <td>{{$person['employee_id']}}</td>
                                    <td>{{$person['name']}}</td>
                                    <td>{{$person['department']}}</td>
                                    <td>{{$person['designation']}}</td>
                                    <td>{{$person['health_status']}}</td>
                                </tr>
                                @endforeach
                              @endif


                            </tbody>
                      </table>
                    
                  </td>
                </tr>
                <tr>
                  <th>Preventative Actions</th>
                  <td>
                      <table class="table text-xxs table-sm table-responsive table-bordered">
                            <thead>
                                <tr>
                                    {{-- <th>Sno</th> --}}
                                    <th>Action</th>
                                    <th>Responsible</th>
                                    <th>Target Date</th>
                                    <th>Actual Completion</th>
                                    <th>Remarks</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                              @if (!empty($near_miss->actions))                                  
                                @foreach ($near_miss->actions as $action)
                                <tr>
                                    {{-- <td>{{$action['sno']}}</td> --}}
                                    <td>{{$action['action']}}</td>
                                    <td>{{$action['responsible']}}</td>
                                    <td>{{$action['target_date']}}</td>
                                    <td>{{$action['actual_completion']}}</td>
                                    <td>{{$action['remarks']}}</td>
                                </tr>
                                @endforeach
                              @endif


                            </tbody>
                      </table>
                    
                  </td>
                </tr>
                <tr>
                  <th>Incident Status</th>
                  <td>{{ $near_miss->incident_status->status_title }}</td>
                </tr>
                <tr>
                  <th>Created At</th>
                  <td>{{ formatDate($near_miss->created_at) }}</td>
                </tr>
                <tr>
                  <th>Updated At</th>
                  <td>{{ formatDate($near_miss->updated_at) }}</td>
                </tr>
              </tbody>
        </table>

        <div class="activites col-12 mt-3">
            <x-others.incident-assigned-activities label="Activities" :incident="$near_miss" displayAsCard="true"></x-others.incident-assigned-activities>
        </div>
        {{-- activites finsihed here --}}

        <button onclick="window.print()" class="btn btn-primary mt-5 d-print-none">Print</button>
    </div>



    {{-- left side --}}
    <div class="col-4">
        <x-others.common-attach-view label="Initial_Attachments" :attachements="$near_miss->initial_attachements" shouldNotCollapse="true"></x-others.common-attach-view>
        <x-others.common-attach-view label="Attachments" :attachements="$near_miss->attachements" shouldNotCollapse="true"></x-others.common-attach-view>
    </div>
</div>
</x-templates.basic-page-temp>     
@endsection
@section('script')

@endsection