@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="View Fire Property Damages">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('fire-property.index')}}">List of Fire Property Damages</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="View Fire Property Damages" page-desc="View Fire Property Damages Details">
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
                  <td>{{ formatDate($fire_property->date) }}</td>
                </tr>
                <tr>
                  <th>Initiated By</th>
                  <td>{{ $fire_property->initiator->first_name }}</td>
                </tr>
                <tr>
                  <th>Reference</th>
                  <td>{{ $fire_property->reference }}</td>
                </tr>
                <tr>
                  <th>Unit</th>
                  <td>{{ $fire_property->unit ? $fire_property->unit->unit_title : ''}}</td>
                </tr>
                <tr>
                  <th>Department</th>
                  <td>{{ $fire_property->department ? $fire_property->department->department_title : ''}}</td>
                </tr>
                <tr>
                  <th>Location</th>
                  <td>{{ $fire_property->meta_location ? $fire_property->meta_location->location_title : '' }}</td>
                </tr>
                <tr>
                  <th>Other Location</th>
                  <td>{{$fire_property->other_location}}</td>
                </tr>
                <tr>
                  <th>Line</th>
                  <td>{{$fire_property->line}}</td>
                </tr>
                <tr>
                  <th>Fire Category</th>
                  <td>{{ $fire_property->fire_category ? $fire_property->fire_category->fire_category_title : '' }}</td>
                </tr>
                <tr>
                  <th>Property Damage</th>
                  <td>{{ $fire_property->property_damage ? $fire_property->property_damage->property_damage_title : '' }}</td>
                </tr>
                <tr>
                  <th>Incident Status</th>
                  <td>{{ $fire_property->incident_status->status_title }}</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>{{ $fire_property->description }}</td>
                </tr>
                <tr>
                  <th>Immediate Action</th>
                  <td>{{ $fire_property->immediate_action }}</td>
                </tr>
                <tr>
                  <th>Immediate Cause</th>
                  <td>{{ $fire_property->immediate_cause }}</td>
                </tr>
                <tr>
                  <th>Root Cause</th>
                  <td>{{ $fire_property->root_cause }}</td>
                </tr>
                <tr>
                  <th>Similar Incident Before</th>
                  <td>{{ $fire_property->similar_incident_before }}</td>
                </tr>
                <tr>
                  <th>Loss Calculation</th>
                  <td>
                    <table class="table table-bordered">
                    <tr>
                        <th>Loss Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                      <tr>
                        <th>Direct Loss</th>
                        <td>{{$fire_property->loss_calculation['direct_loss']['description'] ?? '' }}</td>
                        <td>{{$fire_property->loss_calculation['direct_loss']['value'] ?? '' }}</td>
                      </tr>
                      <tr>
                        <th>Indirect Loss</th>
                        <td>{{$fire_property->loss_calculation['indirect_loss']['description'] ?? '' }}</td>
                        <td>{{$fire_property->loss_calculation['indirect_loss']['value'] ?? '' }}</td>
                      </tr>
                      <tr>
                        <td></td>
                        <th>Total Loss</th>
                        <td>{{$fire_property->loss_calculation['total_loss'] ?? ''}}</td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <th>Loss Recovery Method</th>
                  <td>{{ $fire_property->loss_recovery_method }}</td>
                </tr>
                <tr>
                  <th>Preventative Measure</th>
                  <td>{{ $fire_property->preventative_measure }}</td>
                </tr>
                <tr>
                  <th>Investigated By</th>
                  <td>{{ $fire_property->investigated_by }}</td>
                </tr>
                <tr>
                  <th>Reviewed By</th>
                  <td>{{ $fire_property->reviewed_by}}</td>
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
                          @if ($fire_property->actions)
                          @foreach ($fire_property->actions as $action)
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
            <x-others.incident-assigned-activities label="Activities" :incident="$fire_property" displayAsCard="true"></x-others.incident-assigned-activities>
        </div>
        {{-- activites finsihed here --}}

        <button onclick="window.print()" class="btn btn-primary mt-5 d-print-none">Print</button>
    </div>



    {{-- left side --}}
    <div class="col-4">
        <x-others.common-attach-view label="Initial_Attachments" :attachements="$fire_property->initial_attachements" shouldDelete="false" shouldNotCollapse="true"></x-others.common-attach-view>
        <x-others.common-attach-view label="Attachments" :attachements="$fire_property->attachements" shouldDelete="false" shouldNotCollapse="true"></x-others.common-attach-view>
        {{-- <x-others.common-attach-view label="Interview" :attachements="$fire_property->interview_attachs" shouldDelete="false"></x-others.common-attach-view> --}}
        {{-- <x-others.common-attach-view label="Records" :attachements="$fire_property->record_attachs" shouldDelete="false"></x-others.common-attach-view> --}}
        {{-- <x-others.common-attach-view label="Photographs" :attachements="$fire_property->photograph_attachs" shouldDelete="false"></x-others.common-attach-view> --}}
        {{-- <x-others.common-attach-view label="Other" :attachements="$fire_property->other_attachs" shouldDelete="false"></x-others.common-attach-view> --}}
    </div>
</div>
</x-templates.basic-page-temp>     
@endsection
@section('script')

@endsection

