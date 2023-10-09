@php
    $reportTitle = "Fire Propery Damages";
@endphp

@include('pdf.layout.header')

    <table class="table" style="margin-top:10px">
        
          <tbody>
            @foreach ($data as $fire_property)
            <tr>
              <td style="font-weight: bold"></td>
              <td style="font-weight: bold">Date</td>
              <td style="font-weight: bold">Initiated By</td>
              <td style="font-weight: bold">Reference</td>
              <td style="font-weight: bold">Unit</td>
              <td style="font-weight: bold">Location</td>
              <td style="font-weight: bold">Fire Category</td>
              <td style="font-weight: bold">Property Damage</td>     
              <td style="font-weight: bold">Incident Status</td>

            </tr>
                <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ formatDate($fire_property->date) }}</td>
                <td>{{ $fire_property->initiator->first_name }}</td>
                <td>{{ $fire_property->reference }}</td>
                <td>{{ $fire_property->unit->unit_title }}</td>
                <td>{{ $fire_property->meta_location ? $fire_property->meta_location->location_title : '' }}</td>
                <td>{{ $fire_property->fire_category->fire_category_title ?? '' }}</td>
                <td>{{ $fire_property->property_damage->property_damage_title ?? '' }}</td>
                <td>{{ $fire_property->incident_status->status_title }}</td>
                </tr>
                <tr>
                  <td style="font-weight: bold"></td>
                  <td style="font-weight: bold">Description</td>
                  <td style="font-weight: bold">Immediate Action</td>
                  <td style="font-weight: bold">Immediate Cause</td>
                  <td style="font-weight: bold">Root Cause</td>
                  <td style="font-weight: bold">Similar Incident Before</td>
                  <td style="font-weight: bold">Loss Recovery Method</td>
                  <td style="font-weight: bold">Preventative Measure</td>
                  <td style="font-weight: bold">Created At</td>
                </tr>

                <tr>
                  <td></td>
                  <td>{{ $fire_property->description }}</td>
                  <td>{{ $fire_property->immediate_action }}</td>
                  <td>{{ $fire_property->immediate_cause }}</td>
                  <td>{{ $fire_property->root_cause }}</td>
                  <td>{{ $fire_property->similar_incident_before }}</td>
                  <td>{{ $fire_property->loss_recovery_method }}</td>
                  <td>{{ $fire_property->preventative_measure }}</td>
                  <td>{{ formatDate($fire_property->created_at)}}</td>
                </tr>

                <tr>
                  <td style="font-weight: bold"></td>
                  <td style="font-weight: bold"></td>
                  <td style="font-weight: bold">Actions</td>
                  <td style="font-weight: bold;">Loss Calculation</td>
                 
                </tr>

                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <table class="table text-xxs table-sm table-responsive table-bordered">
                      <thead>
                          <tr>
                              {{-- <th>Sno</th> --}}
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
                            {{-- <td>{{$action['sno']}}</td> --}}
                            <td>{{$action['description']}}</td>
                            <td>{{@$action['responsibility']}}</td>
                            <td>{{$action['timeline']}}</td>
                            <td>{{$action['status']}}</td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                </table>
                  </td>
                  <td>
                    <table class="table table-bordered">
                      <tr>
                          <th>Loss Type</th>
                          <th>Description</th>
                          <th>Amount</th>
                      </tr>
                        <tr>
                          <th>Direct Loss</th>
                          <td>{{$fire_property->loss_calculation['direct_loss']['description'] ?? '' }}</td>
                          <td>{{$fire_property->loss_calculation['direct_loss']['value'] ?? '' }}</td>
                        </tr>
                        <tr>
                          <th>Indirect Loss</th>
                          <td>{{$fire_property->loss_calculation['indirect_loss']['description'] ?? '' }}</td>
                          <td>{{$fire_property->loss_calculation['indirect_loss']['value'] ?? '' }}</td>
                        </tr>
                        <tr>
                          <td></td>
                          <th>Total Loss</th>
                          <td>{{$fire_property->loss_calculation['total_loss'] ?? ''}}</td>
                        </tr>
                      </table>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                </tr>

                
            @endforeach
          </tbody>
      </table>
    
    
  @include('pdf.layout.footer')
