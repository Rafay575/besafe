@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="View Injry">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('injuries.index')}}">List of Injry</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="View Injry" page-desc="View Injry Details">
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
                    <th>ID</th>
                    <td>{{ $injury->id }}</td>
                  </tr>
                 <tr>
                    <th>Reference</th>
                    <td>{{ $injury->reference }}</td>
                  </tr>
                 <tr>
                    <th>Time</th>
                    <td>{{ $injury->time }}</td>
                  </tr>
                 <tr>
                    <th>Date</th>
                    <td>{{ formatDate($injury->date) }}</td>
                  </tr>
                  <tr>
                    <th>Initiated By</th>
                    <td>{{ $injury->initiator->first_name }}</td>
                  </tr>
                  <tr>
                    <th>Unit</th>
                    <td>{{ $injury->unit ? $injury->unit->unit_title : '' }}</td>
                  </tr>
                  <tr>
                    <th>Department</th>
                    <td>{{ $injury->department ? $injury->department->department_title : '' }}</td>
                  </tr>
                  <tr>
                    <th>Location</th>
                    <td>{{ $injury->meta_location ? $injury->meta_location->location_title : '' }}</td>
                  </tr>
                  <tr>
                    <th>Other Location</th>
                    <td>{{ $injury->other_location}}</td>
                  </tr>
                  <tr>
                    <th>Line</th>
                    <td>{{ $injury->line}}</td>
                  </tr>
                  
                  
                  <tr>
                    <th>Meta Injury Category</th>
                    <td>{{ $injury->injury_category ? $injury->injury_category->injury_category_title : '' }}</td>
                  </tr>
                  
                  <tr>
                    <th>Meta Incident Category</th>
                    <td>{{ $injury->incident_category ? $injury->incident_category->incident_category_title : '' }}</td>
                  </tr>
                  <tr>
                    <th>Meta Incident Status</th>
                    <td>{{ $injury->incident_status->status_title }}</td>
                  </tr>
                  <tr>
                    <th>Employee Involved</th>
                    <td>{{ $injury->employee_involved }}</td>
                  </tr>
                  <tr>
                    <th>Injured Person</th>
                    <td>{{ $injury->injured_person}}</td>
                  </tr>
                  <tr>
                    <th>Witness Name</th>
                    <td>{{ $injury->witness_name }}</td>
                  </tr>
                  {{-- <tr>
                    <th>SGFL Relation</th>
                    <td>{{$injury->meta_sgfl_relation_id ?  $injury->msgfl_relation->sgfl_relation_title : '' }}</td>
                  </tr> --}}
                  <tr>
                    <th>Details</th>
                    <td>{{ $injury->details }}</td>
                  </tr>
                  <tr>
                    <th>Immediate Action</th>
                    <td>{{ $injury->immediate_action }}</td>
                  </tr>
                  <tr>
                    <th>Key Finding</th>
                    <td>{{ $injury->key_finding }}</td>
                  </tr>
                  <tr>
                    <th>Created At</th>
                    <td>{{ formatDate($injury->created_at) }}</td>
                  </tr>

                  <tr>
                    <th>Immediate Causes</th>
                    <td>{{ $injury->immediate_causes ? $injury->immediate_causes->pluck('cause_title')->implode(', ') : '' }}</td>
                  </tr>
                  {{-- <tr>
                    <th>Root Causes</th>
                    <td>{{ $injury->root_causes ? $injury->root_causes->pluck('cause_title')->implode(', ') : '' }}</td>
                  </tr> --}}
                  {{-- <tr>
                    <th>Basic Causes</th>
                    <td>{{ $injury->basic_causes ? $injury->basic_causes->pluck('cause_title')->implode(', ') : '' }}</td>
                  </tr> --}}

                  <tr>
                    <th>Root Cause</th>
                    <td>{{$injury->root_cause}}</td>
                  </tr>
                  <tr>
                    <th>Contact Types</th>
                    <td>{{ $injury->contacts ? $injury->contacts->pluck('type_title')->implode(', ') : '' }}</td>
                  </tr>

                  <tr>
                    <th>Updated At</th>
                    <td>{{ formatDate($injury->updated_at) }}</td>
                  </tr>
              
                <tr>
                  <th>Actions</th>
                  <td>
                    <table class="table text-xxs table-sm table-responsive table-bordered">
                        <thead>
                            <tr>
                                {{-- <th>Sno</th> --}}
                                <th>Description</th>
                                <th>Responsibility</th>
                                <th>Timeline</th>
                                <th>Status</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                          @if ($injury->actions)
                          @foreach ($injury->actions as $action)
                          <tr>
                              {{-- <td>{{$action['sno']}}</td> --}}
                              <td>{{@$action['description']}}</td>
                              <td>{{@$action['responsibility']}}</td>
                              <td>{{@$action['timeline']}}</td>
                              <td>{{@$action['status']}}</td>
                          </tr>
                          @endforeach
                          @endif
                        </tbody>
                  </table>
                  </td>
                </tr>
              </tbody>
        
            </table>

        <div class="activites col-12 mt-3">
            <x-others.incident-assigned-activities label="Activities" :incident="$injury" displayAsCard="true"></x-others.incident-assigned-activities>
        </div>
        {{-- activites finsihed here --}}

        <button onclick="window.print()" class="btn btn-primary mt-5 d-print-none">Print</button>
    </div>



    {{-- left side --}}
    <div class="col-4">
        <x-others.common-attach-view label="Initial_Attachments" :attachements="$injury->initial_attachements" shouldDelete="false"></x-others.common-attach-view>
        <x-others.common-attach-view label="Attachments" :attachements="$injury->attachements" shouldDelete="false"></x-others.common-attach-view>
        {{-- <x-others.common-attach-view label="Interview" :attachements="$injury->interview_attachs" shouldDelete="false"></x-others.common-attach-view> --}}
    </div>
</div>
</x-templates.basic-page-temp>     
@endsection
@section('script')

@endsection

