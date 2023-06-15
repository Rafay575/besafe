@php
    $reportTitle = "Permit To Work";
@endphp

@include('pdf.layout.header')
<table class="table align-items-center mt-5">
    <tbody>
        <tr>
            <th>Initiated By</th>
            <td>{{ $ptw->initiator->first_name }}</td>
        </tr>
        <tr>
            <th>Start Time</th>
            <td>{{ $ptw->start_time }}</td>
        </tr>
        <tr>
            <th>End Time</th>
            <td>{{ $ptw->end_time }}</td>
        </tr>
        <tr>
            <th>Work Area</th>
            <td>{{ $ptw->work_area }}</td>
        </tr>
        <tr>
            <th>Line/Machine</th>
            <td>{{ $ptw->line_machine }}</td>
        </tr>
        <tr>
            <th>Is PTW Exist</th>
            <td>{{ $ptw->is_ptw_exist ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>Cross Reference</th>
            <td>{{ $ptw->cross_reference }}</td>
        </tr>
        <tr>
            <th>MOC Required</th>
            <td>{{ $ptw->moc_required ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <th>MOC Title</th>
            <td>{{ $ptw->moc_title }}</td>
        </tr>
        <tr>
            <th>MOC Description</th>
            <td>{{ $ptw->moc_desc }}</td>
        </tr>
        <tr>
            <th>PTW Type</th>
            <td>{{$ptw->meta_ptw_type_id ? $ptw->ptw_type->ptw_type_title : ''}}</td>
        </tr>
        <tr>
            <th>Working Group</th>
            <td>{{ $ptw->working_group }}</td>
        </tr>
        <tr>
            <th>Worker Name</th>
            <td>{{ $ptw->worker_name }}</td>
        </tr>
        <tr>
            <th>PTW Item</th>
            <td>{{ $ptw->ptw_items ? $ptw->ptw_items->pluck('ptw_item_title')->implode(', ') : '' }}</td>
        </tr>
        <tr>
            <th>Work Description</th>
            <td>{{ $ptw->work_desc }}</td>
        </tr>
     
        <tr>
            <th>Created At</th>
            <td>{{ $ptw->created_at }}</td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>{{ $ptw->updated_at }}</td>
        </tr>
    </tbody>

</table>
@include('pdf.layout.footer')
