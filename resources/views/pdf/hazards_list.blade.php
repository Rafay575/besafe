@php
    $reportTitle = "Hazards";
@endphp

@include('pdf.layout.header')

    <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Unit</th>
            <th>Initiated By</th>
            <th>Department</th>
            <th>Line</th>
            <th>Risk Level</th>
            <th>Department Tag</th>
            <th>Incident Status</th>
            <th>Location</th>
            <th>Description</th>
            <th>Date</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $hazard)
          {{-- <tr>
            <td>{{ $hazard->id }}</td>
            <td>{{ $hazard->unit->unit_title }}</td>
            <td>{{ $hazard->initiator->first_name }}</td>
            <td>{{ $hazard->department->department_title ?? '' }}</td>
            <td>{{ $hazard->line->line_title ?? ''}}</td>
            <td>{{ $hazard->risk_level->risk_level_title ?? '' }}</td>
            <td>{{ $hazard->department_tag->department_tag_title ?? '' }}</td>
            <td>{{ $hazard->incident_status->status_title  ?? ''}}</td>
            <td>{{ $hazard->location }}</td>
            <td>{{ $hazard->description }}</td>
            <td>{{ $hazard->date }}</td>
            <td>{{ $hazard->created_at->format('m-d-Y') }}</td>
          </tr> --}}
          @endforeach
        </tbody>
      </table>
    
    
  @include('pdf.layout.footer');
