@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Injuries List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Injuries List" page-desc="List of Injuries">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            @can('injury.create')
            <a href="{{route('injuries.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New Injuries</a>
                
            @endcan
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="injuries-table" data-source="{{route('injuries.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="    S.No,Date,Incident Category,Injury Category,Employee Involved, SGFL Relation,Status,Action"></x-table.tblhead>
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
  const table = $('#injuries-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'date', name: 'date' },
      { data: 'incident_category', name: 'incident_category' },
      { data: 'injury_category', name: 'injury_category' },
      { data: 'employee_involved', name: 'employee_involved' },
      { data: 'sgfl_relation', name: 'sgfl_relation' },
      { data: 'incident_status', name: 'incident_status' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection