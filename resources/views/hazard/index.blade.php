@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="hazard List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="hazard List" page-desc="List of Registered hazard">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            @can('hazard.create')
            <a href="{{route('hazards.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New hazard</a>
                
            @endcan
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="hazard-table" data-source="{{route('hazards.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Unit,Date,Department,Location,Line,Risk Level,Status,Action"></x-table.tblhead>
              </thead>
              <tbody>
              </tbody>
             
            </table>
        </div>
      {{-- defautl slot end here --}}

   </x-templates.basic-page-temp>

@endsection
@section('script')
<script>    
$(document).ready(function() {
  const table = $('#hazard-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'unit', name: 'unit' },
      { data: 'date', name: 'date' },
      { data: 'department', name: 'department' },
      { data: 'location', name: 'location' },
      { data: 'line', name: 'line' },
      { data: 'risk_level', name: 'risk_level' },
      { data: 'incident_status', name: 'incident_status' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection