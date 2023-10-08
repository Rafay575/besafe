@php
    $reportTitle = "Unsafe Behaviors";
@endphp

@include('pdf.layout.header')
 
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Initiated By</th>
                <th>Unit</th>
                <th>Department</th>
                <th>Line</th>
                <th>Location</th>
                <th>Unsafe Behavior Types</th>
                <th>Unsafe Behavior Actions</th>
                <th>Action</th>
                <th>Status</th>
                <th>Details</th>
              </tr>
          </thead>
          <tbody>
            

            @foreach ($data as $unsafe_behavior)
            @php
            $types = $unsafe_behavior->unsafe_behavior_types ? $unsafe_behavior->unsafe_behavior_types->pluck('unsafe_behavior_type_title')->toArray() : [];
              $types = implode(', ', $types);
             @endphp
            <tr>
                <td>{{ formatDate($unsafe_behavior->date) }}</td>
                <td>{{ $unsafe_behavior->initiator->first_name ?? '' }}</td>
                <td>{{ $unsafe_behavior->unit->unit_title ?? '' }}</td>
                <td>{{ $unsafe_behavior->department->department_title ?? '' }}</td>
                <td>{{ $unsafe_behavior->line}}</td>
                <td>{{ $unsafe_behavior->meta_location ? $unsafe_behavior->meta_location->location_title : '' }}</td>
                <td>{{$types}}</td>
                <td>{{ $unsafe_behavior->unsafe_behavior_action->action_title ?? '' }}</td>
                <td>{{ $unsafe_behavior->action }}</td>
                <td>{{ $unsafe_behavior->incident_status->status_title ?? '' }}</td>
                <td>{{ $unsafe_behavior->details }}</td>
              </tr>
            @endforeach
          </tbody>
      </table>
    
    
  @include('pdf.layout.footer')
