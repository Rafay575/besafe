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
                  <td>{{ $near_miss->date }}</td>
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
                  <td>{{ $near_miss->location }}</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>{{ $near_miss->description }}</td>
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
                  <td>{{ $near_miss->created_at }}</td>
                </tr>
                <tr>
                  <th>Updated At</th>
                  <td>{{ $near_miss->updated_at }}</td>
                </tr>
              </tbody>
        </table>

        <div class="activites col-12 mt-3">
            <x-others.incident-assigned-activities label="Activities" :incident="$near_miss" displayAsCard="true"></x-others.incident-assigned-activities>
        </div>
        {{-- activites finsihed here --}}

        <button onclick="window.print()" class="btn btn-primary mt-5">Print</button>
    </div>



    {{-- left side --}}
    <div class="col-4">
        <x-others.common-attach-view label="Attachments" :attachements="$near_miss->attachements" shouldNotCollapse="true"></x-others.common-attach-view>
    </div>
</div>
</x-templates.basic-page-temp>     
@endsection
@section('script')

@endsection