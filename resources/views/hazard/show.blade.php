@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="View Hazard">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('hazards.index')}}">List of Hazards</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="View Hazard" page-desc="View Hazard Details">
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
                  <th>Unit</th>
                  <td>{{ $hazard->unit ? $hazard->unit->unit_title : '' }}</td>
                </tr>
                <tr>
                  <th>Initiated By</th>
                  <td>{{ $hazard->initiator ? $hazard->initiator->first_name : ''}}</td>
                </tr>
                <tr>
                  <th>Department</th>
                  <td>{{ $hazard->department ? $hazard->department->department_title : ''}}</td>
                </tr>
                <tr>
                  <th>Location</th>
                  <td>{{ $hazard->meta_location ? $hazard->meta_location->location_title : ''}}</td>
                </tr>
                <tr>
                  <th>Other Location</th>
                  <td>{{ $hazard->other_location }}</td>
                </tr>
                <tr>
                  <th>Line</th>
                  <td>{{ $hazard->line }}</td>
                </tr>
                <tr>
                  <th>Risk Level</th>
                  <td>{{ $hazard->risk_level->risk_level_title }}</td>
                </tr>
                <tr>
                  <th>Department Tag</th>
                  <td>{{ $hazard->department_tag->department_tag_title }}</td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td>{{ $hazard->incident_status->status_title }}</td>
                </tr>
               
                <tr>
                  <th>Description</th>
                  <td>{{ $hazard->description }}</td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td>{{ $hazard->date }}</td>
                </tr>
                <tr>
                  <th>Action Cost</th>
                  <td>{{ $hazard->action_cost }}</td>
                </tr>
                <tr>
                  <th>Action</th>
                  <td>{{ $hazard->action }}</td>
                </tr>
                <tr>
                  <th>Created At</th>
                  <td>{{ $hazard->created_at }}</td>
                </tr>
                <tr>
                  <th>Updated At</th>
                  <td>{{ $hazard->updated_at }}</td>
                </tr>
              </tbody>
        </table>

        <div class="activites col-12 mt-3">
            <x-others.incident-assigned-activities label="Activities" :incident="$hazard" displayAsCard="true"></x-others.incident-assigned-activities>
        </div>
        {{-- activites finsihed here --}}

        <button onclick="window.print()" class="btn btn-primary mt-5 d-print-none">Print</button>
    </div>



    {{-- left side --}}
    <div class="col-5">
        <x-others.common-attach-view label="Initial_Attachments" :attachements="$hazard->initial_attachements" shouldNotCollapse="true"></x-others.common-attach-view>
        <x-others.common-attach-view label="Attachments" :attachements="$hazard->attachements" shouldNotCollapse="true"></x-others.common-attach-view>
    </div>
</div>
</x-templates.basic-page-temp>     
@endsection
@section('script')

@endsection