@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Unsafe Behaviors List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Unsafe Behaviors" page-desc="List of Unsafe Behaviors">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            <a href="{{route('unsafe-behaviors.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Add New</a>
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="unsafe-behavior-table" data-source="{{route('unsafe-behaviors.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Unit,Department,Line,Date,Status,Action"></x-table.tblhead>
              </thead>
              <tbody>
                
              </tbody>
             
            </table>
        </div>
      {{-- defautl slot end here --}}

   </x-templates.basic-page-temp>

   {{-- modals --}}
   <x-modals.basic-modal title="User Create" id="userCreate" footer="yes" header="no" class="modal fade modal-lg">
    <h1>here</h1>
   </x-modals.basic-modal>
   <!-- Modal -->

@endsection
@section('script')
<script>

$(document).ready(function() {
  const table  = $('#unsafe-behavior-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'unit', name: 'unit' },
      { data: 'department', name: 'department' },
      { data: 'line', name: 'line' },
      { data: 'date', name: 'date' },
      { data: 'incident_status', name: 'incident_status' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection