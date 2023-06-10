@php
    $reportTitle = "Near Misses";
@endphp

@include('pdf.layout.header')

    <table class="table">
        <thead>
            <tr>
              <th>Date</th>
              <th>Time</th>
              <th>Initiated By</th>
              <th>Location</th>
              <th>Description</th>
              <th>Immediate Action</th>
              <th>Immediate Cause</th>
              <th>Root Cause</th>
              <th>Incident Status</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($data as $near_miss)
           <tr>
            <td>{{ $near_miss->date }}</td>
            <td>{{ $near_miss->time }}</td>
            <td>{{ $near_miss->initiator->first_name }}</td>
            <td>{{ $near_miss->location }}</td>
            <td>{{ $near_miss->description }}</td>
            <td>{{ $near_miss->immediate_action }}</td>
            <td>{{ $near_miss->immediate_cause }}</td>
            <td>{{ $near_miss->root_cause }}</td>
            <td>{{ $near_miss->incident_status->status_title }}</td>
            <td>{{ $near_miss->created_at->format('d-m-Y') }}</td>
          </tr>
           @endforeach
          </tbody>
      </table>
    
    
  @include('pdf.layout.footer')
