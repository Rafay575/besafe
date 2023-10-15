@php
    $reportTitle = "Injuries";
@endphp

@include('pdf.layout.header')

@foreach ($data as $injury)
<table class="table">
  <tbody>
          <tr>
              <th>S.NO</th>
              <td>{{ $loop->iteration }}</td>
              <th>ID</th>
              <td>{{ $injury->id }}</td>
              <th>Reference</th>
              <td>{{ $injury->reference }}</td>
              <th>Time</th>
              <td>{{ $injury->time }}</td>
              <th>Date</th>
              <td>{{ formatDate($injury->date) }}</td>
              <th>Initiated By</th>
              <td>{{ $injury->initiator->first_name }}</td>
          </tr>

          <tr>
              <th>Unit</th>
              <td>{{ $injury->unit ? $injury->unit->unit_title : '' }}</td>
              <th>Department</th>
              <td>{{ $injury->department ? $injury->department->department_title : '' }}</td>
              <th>Location</th>
              <td>{{ $injury->meta_location ? $injury->meta_location->location_title : '' }}</td>
              <th>Other Location</th>
              <td>{{ $injury->other_location }}</td>
          </tr>

          <tr>
              <th>Line</th>
              <td>{{ $injury->line }}</td>
              <th>Meta Injury Category</th>
              <td>{{ $injury->injury_category ? $injury->injury_category->injury_category_title : '' }}</td>
              <th>Meta Incident Category</th>
              <td>{{ $injury->incident_category ? $injury->incident_category->incident_category_title : '' }}</td>
          </tr>

          <tr>
              <th>Meta Incident Status</th>
              <td>{{ $injury->incident_status->status_title }}</td>
              <th>Employee Involved</th>
              <td>{{ $injury->employee_involved }}</td>
              <th>Injured Person</th>
              <td>{{ $injury->injured_person }}</td>
          </tr>

          <tr>
              <th>Witness Name</th>
              <td>{{ $injury->witness_name }}</td>
              <th>Details</th>
              <td>{{ $injury->details }}</td>
              <th>Immediate Action</th>
              <td>{{ $injury->immediate_action }}</td>
          </tr>

          <tr>
              <th>Key Finding</th>
              <td>{{ $injury->key_finding }}</td>
              <th>Created At</th>
              <td>{{ formatDate($injury->created_at) }}</td>
              <th>Immediate Causes</th>
              <td>{{ $injury->immediate_causes ? $injury->immediate_causes->pluck('cause_title')->implode(', ') : '' }}</td>
          </tr>

          <tr>
              <th>Root Cause</th>
              <td>{{ $injury->root_cause }}</td>
              <th>Contact Types</th>
              <td>{{ $injury->contacts ? $injury->contacts->pluck('type_title')->implode(', ') : '' }}</td>
              <th>Updated At</th>
              <td>{{ formatDate($injury->updated_at) }}</td>
          </tr>

          <tr>
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
                          @if ($injury->actions)
                              @foreach ($injury->actions as $action)
                                  <tr>
                                      <td>{{ $action['description'] }}</td>
                                      <td>{{ $action['responsibility'] }}</td>
                                      <td>{{ $action['timeline'] }}</td>
                                      <td>{{ $action['status'] }}</td>
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
