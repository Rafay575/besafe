@php
    $reportTitle = "Fire Propery Damages";
@endphp

@include('pdf.layout.header')

@foreach ($data as $fire_property)
<table class="table">
  <tbody>
          <tr>
              <th>S.No</th>
              <td>{{ $loop->iteration }}</td>
              <th>Date</th>
              <td>{{ formatDate($fire_property->date) }}</td>
              <th>Initiated By</th>
              <td>{{ $fire_property->initiator->first_name }}</td>
              <th>Reference</th>
              <td>{{ $fire_property->reference }}</td>
          </tr>

          <tr>
              <th>Unit</th>
              <td>{{ $fire_property->unit ? $fire_property->unit->unit_title : '' }}</td>
              <th>Department</th>
              <td>{{ $fire_property->department ? $fire_property->department->department_title : '' }}</td>
              <th>Location</th>
              <td>{{ $fire_property->meta_location ? $fire_property->meta_location->location_title : '' }}</td>
          </tr>

          <tr>
              <th>Other Location</th>
              <td>{{ $fire_property->other_location }}</td>
              <th>Line</th>
              <td>{{ $fire_property->line }}</td>
              <th>Fire Category</th>
              <td>{{ $fire_property->fire_category ? $fire_property->fire_category->fire_category_title : '' }}</td>
          </tr>

          <tr>
              <th>Property Damage</th>
              <td>{{ $fire_property->property_damage ? $fire_property->property_damage->property_damage_title : '' }}</td>
              <th>Incident Status</th>
              <td>{{ $fire_property->incident_status->status_title }}</td>
              <th>Description</th>
              <td>{{ $fire_property->description }}</td>
          </tr>

          <tr>
              <th>Immediate Action</th>
              <td>{{ $fire_property->immediate_action }}</td>
              <th>Immediate Cause</th>
              <td>{{ $fire_property->immediate_cause }}</td>
              <th>Root Cause</th>
              <td>{{ $fire_property->root_cause }}</td>
          </tr>

          <tr>
              <th>Similar Incident Before</th>
              <td>{{ $fire_property->similar_incident_before }}</td>
              <th>Loss Calculation</th>
              <td colspan="14">
                  <table class="table table-bordered">
                      <tr>
                          <th>Loss Type</th>
                          <th>Description</th>
                          <th>Amount</th>
                      </tr>
                      <tr>
                          <th>Direct Loss</th>
                          <td>{{ $fire_property->loss_calculation['direct_loss']['description'] ?? '' }}</td>
                          <td>{{ $fire_property->loss_calculation['direct_loss']['value'] ?? '' }}</td>
                      </tr>
                      <tr>
                          <th>Indirect Loss</th>
                          <td>{{ $fire_property->loss_calculation['indirect_loss']['description'] ?? '' }}</td>
                          <td>{{ $fire_property->loss_calculation['indirect_loss']['value'] ?? '' }}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <th>Total Loss</th>
                          <td>{{ $fire_property->loss_calculation['total_loss'] ?? '' }}</td>
                      </tr>
                  </table>
              </td>
          </tr>

          <tr>
              <th>Loss Recovery Method</th>
              <td>{{ $fire_property->loss_recovery_method }}</td>
              <th>Preventative Measure</th>
              <td>{{ $fire_property->preventative_measure }}</td>
              <th>Investigated By</th>
              <td>{{ $fire_property->investigated_by }}</td>
          </tr>

          <tr>
              <th>Reviewed By</th>
              <td>{{ $fire_property->reviewed_by }}</td>
              <th>Actions</th>
              <td colspan="14">
                  <table class="table text-xxs table-sm table-responsive table-bordered">
                      <thead>
                          <tr>
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
                                      <td>{{ @$action['description'] }}</td>
                                      <td>{{ @$action['responsibility'] }}</td>
                                      <td>{{ @$action['timeline'] }}</td>
                                      <td>{{ @$action['status'] }}</td>
                                  </tr>
                              @endforeach
                          @endif
                      </tbody>
                  </table>
              </td>
          </tr>
        </tbody>
      </table>
    @endforeach

    
  
  
      @include('pdf.layout.footer')
