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
                <th>Status</th>
                <th>Details</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($data as $unsafe_behavior)
            <tr>
                <td>{{ $unsafe_behavior->date }}</td>
                <td>{{ $unsafe_behavior->initiator->first_name ?? '' }}</td>
                <td>{{ $unsafe_behavior->unit->unit_title ?? '' }}</td>
                <td>{{ $unsafe_behavior->department->department_title ?? '' }}</td>
                <td>{{ $unsafe_behavior->line->line_title ?? '' }}</td>
                <td>{{ $unsafe_behavior->incident_status->status_title ?? '' }}</td>
                <td>{{ $unsafe_behavior->details }}</td>
              </tr>
            @endforeach
          </tbody>
      </table>
    
    
  @include('pdf.layout.footer')
