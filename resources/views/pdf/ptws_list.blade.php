@php
    $reportTitle = "Permit To Work";
@endphp

@include('pdf.layout.header')

    <table class="table">
        <thead>
            <tr>
              <th>Initiated By</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Work Area</th>
              <th>Line/Machine</th>
              <th>Is PTW Exist</th>
              <th>Cross Reference</th>
              <th>MOC Required</th>
              <th>MOC Title</th>
              <th>MOC Description</th>
              <th>PTW Type</th>
              <th>Working Group</th>
              <th>Worker Name</th>
              <th>PTW Item</th>
              <th>Work Description</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $ptw)
            <tr>
                <td>{{ $ptw->initiator->first_name }}</td>
                <td>{{ $ptw->start_time }}</td>
                <td>{{ $ptw->end_time }}</td>
                <td>{{ $ptw->work_area }}</td>
                <td>{{ $ptw->line_machine }}</td>
                <td>{{ $ptw->is_ptw_exist ? 'Yes' : 'No' }}</td>
                <td>{{ $ptw->cross_reference }}</td>
                <td>{{ $ptw->moc_required ? 'Yes' : 'No' }}</td>
                <td>{{ $ptw->moc_title }}</td>
                <td>{{ $ptw->moc_desc }}</td>
                <td>{{ $ptw->meta_ptw_type_id ? $ptw->ptw_type->ptw_type_title : '' }}</td>
                <td>{{ $ptw->working_group }}</td>
                <td>{{ $ptw->worker_name }}</td>
                <td>{{ $ptw->ptw_items ? $ptw->ptw_items->pluck('ptw_item_title')->implode(', ') : '' }}</td>
                <td>{{ $ptw->work_desc }}</td>
                <td>{{ $ptw->created_at->format('d-m-Y') }}</td>
              </tr>
            @endforeach
          </tbody>
      </table>
    
    
  @include('pdf.layout.footer')
