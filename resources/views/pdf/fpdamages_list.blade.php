@php
    $reportTitle = "Fire Propery Damages";
@endphp

@include('pdf.layout.header')

    <table class="table">
        <thead>
            <tr>
              <th>Date</th>
              <th>Initiated By</th>
              <th>Reference</th>
              <th>Unit</th>
              <th>Location</th>
              <th>Fire Category</th>
              <th>Property Damage</th>
              <th>Incident Status</th>
              <th>Description</th>
              <th>Immediate Action</th>
              <th>Immediate Cause</th>
              <th>Root Cause</th>
              <th>Similar Incident Before</th>
              <th>Loss Recovery Method</th>
              <th>Preventative Measure</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $fire_property)
                <tr>
                <td>{{ $fire_property->date }}</td>
                <td>{{ $fire_property->initiator->first_name }}</td>
                <td>{{ $fire_property->reference }}</td>
                <td>{{ $fire_property->unit->unit_title }}</td>
                <td>{{ $fire_property->location }}</td>
                <td>{{ $fire_property->fire_category->fire_category_title ?? '' }}</td>
                <td>{{ $fire_property->property_damage->property_damage_title ?? '' }}</td>
                <td>{{ $fire_property->incident_status->status_title }}</td>
                <td>{{ $fire_property->description }}</td>
                <td>{{ $fire_property->immediate_action }}</td>
                <td>{{ $fire_property->immediate_cause }}</td>
                <td>{{ $fire_property->root_cause }}</td>
                <td>{{ $fire_property->similar_incident_before }}</td>
                <td>{{ $fire_property->loss_recovery_method }}</td>
                <td>{{ $fire_property->preventative_measure }}</td>
                <td>{{ $fire_property->created_at->format('m-d-Y') }}</td>
                </tr>
            @endforeach
          </tbody>
      </table>
    
    
  @include('pdf.layout.footer')
