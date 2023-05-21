@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Fire and Property damage List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Fire and Property damage List" page-desc="List of Fire and Property damage">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            <a href="{{route('fire-property.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New damage</a>
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="fire-property-damage-table" data-source ="{{route('fire-property.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Date,Reference,Unit,Location,Status,Action"></x-table.tblhead>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <x-table.tblhead heads="S.No,Date,Reference,Unit,Location,Status,Action"></x-table.tblhead>
              </tfoot>
            </table>
        </div>
      {{-- defautl slot end here --}}

   </x-templates.basic-page-temp>

@endsection

@section('script')
<script>    
$(document).ready(function() {
  const table = $('#fire-property-damage-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'date', name: 'date' },
      { data: 'reference', name: 'reference' },
      { data: 'unit', name: 'unit' },
      { data: 'location', name: 'location' },
      { data: 'incident_status', name: 'incident_status' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection