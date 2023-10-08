@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Near Miss List">
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="Near Miss List" page-desc="List of Near Misses">
  {{-- x-slot:pageheader referes to the second slot in one componenet --}}
    <x-slot:pageHeader>
      <div class="ms-auto my-auto mt-lg-0 mt-4">
        <div class="ms-auto my-auto">
          @can('near_miss.create')
          <a href="{{route('near-miss.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New Near Miss</a>
          @endcan
        </div>
      </div>
    </x-slot>
    {{-- x slot page header ends here --}}

    {{-- default slot starts here --}}
      <div class="table-responsive">
          <table class="table table-flush" id="near-miss-table" data-source="{{route('near-miss.index')}}">
            <thead class="thead-light">
              <x-table.tblhead heads="S.No,Date,Employee Name,Near Miss Classification,Time,Unit,Location,Status,Action"></x-table.tblhead>
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
  const table = $('#near-miss-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },

    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'date', name: 'date' },
      { data: 'employee_name', name: 'employee_name'},
      { data: 'near_miss_class', name: 'near_miss_class' },
      { data: 'time', name: 'time' },
      { data: 'unit', name: 'unit' },
      { data: 'location', name: 'location' },
      { data: 'incident_status', name: 'incident_status' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection