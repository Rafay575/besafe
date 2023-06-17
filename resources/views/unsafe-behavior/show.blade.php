@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="View Unsafe Behavior">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('unsafe-behaviors.index')}}">List of Unsafe Behavior</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="View Unsafe Behavior" page-desc="View Unsafe Behavior Details">
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
        <div class="table-responsive col-6">
            <table class="table align-items-center mb-0 table-bordered col-12">
                <tbody>
                    <tr>
                        <th>Date</th>
                        <td>{{ $unsafe_behavior->date }}</td>
                    </tr>
                    <tr>
                        <th>Initiated By</th>
                        <td>{{ $unsafe_behavior->initiator->first_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Unit</th>
                        <td>{{ $unsafe_behavior->unit->unit_title ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td>{{ $unsafe_behavior->department->department_title ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Actions Taken</th>
                        <td>{{ $unsafe_behavior->unsafe_behavior_action->action_title ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Line</th>
                        <td>{{ $unsafe_behavior->line->line_title ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $unsafe_behavior->incident_status->status_title ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Details</th>
                        <td>{{ $unsafe_behavior->details }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="activites col-12 mt-3">
                <x-others.incident-assigned-activities label="Activities" :incident="$unsafe_behavior" displayAsCard="true"></x-others.incident-assigned-activities>
            </div>
            {{-- activites finsihed here --}}

            <button onclick="window.print()" class="btn btn-primary mt-5">Print</button>
        </div>



        {{-- left side --}}
        <div class="col-5">
            <x-others.common-attach-view label="Attachments" :attachements="$unsafe_behavior->attachements" shouldNotCollapse="true"></x-others.common-attach-view>
        </div>
    </div>
</x-templates.basic-page-temp> 
@endsection
