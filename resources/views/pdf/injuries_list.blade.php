@php
    $reportTitle = "Injuries";
@endphp

@include('pdf.layout.header')

    <table class="table">
        <thead>
            <tr>
              <th>ID</th>
              <th>Initiated By</th>
              <th>Meta Injury Category</th>
              <th>Meta Incident Category</th>
              <th>Meta Incident Status</th>
              <th>Employee Involved</th>
              <th>Witness Name</th>
              <th>SGFL Relation</th>
              <th>Details</th>
              <th>Immediate Action</th>
              <th>Key Finding</th>
              <th>Immediate Causes</th>
              <th>Root Causes</th>
              <th>Basic Causes</th>
              <th>Contact Types</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $injury)
                <tr>
                <td>{{ $injury->id }}</td>
                <td>{{ $injury->initiator->first_name }}</td>
                <td>{{ $injury->injury_category->injury_category_title }}</td>
                <td>{{ $injury->incident_category->incident_category_title }}</td>
                <td>{{ $injury->incident_status->status_title }}</td>
                <td>{{ $injury->employee_involved }}</td>
                <td>{{ $injury->witness_name }}</td>
                <td>{{$injury->meta_sgfl_relation_id ?  $injury->msgfl_relation->sgfl_relation_title : '' }}</td>
                <td>{{ $injury->details }}</td>
                <td>{{ $injury->immediate_action }}</td>
                <td>{{ $injury->key_finding }}</td>
                <td>{{ $injury->immediate_causes ? $injury->immediate_causes->pluck('cause_title')->implode(', ') : '' }}</td>
                <td>{{ $injury->root_causes ? $injury->root_causes->pluck('cause_title')->implode(', ') : '' }}</td>
                <td>{{ $injury->basic_causes ? $injury->basic_causes->pluck('cause_title')->implode(', ') : '' }}</td>
                <td>{{ $injury->contacts ? $injury->contacts->pluck('type_title')->implode(', ') : '' }}</td>
                <td>{{ $injury->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
          </tbody>
      </table>
    
    
  @include('pdf.layout.footer')
