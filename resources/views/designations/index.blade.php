@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Designations List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Designations" page-desc="List of Designations">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          @can('adminsetting.create')              
          <div class="ms-auto my-auto">
            <a href="{{route('designations.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Add New</a>
          </div>
          @endcan
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive ">
            <table class="table table-flush table-striped" id="designations-table" data-source="{{route('designations.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Name,Action"></x-table.tblhead>
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
  const table  = $('#designations-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },

    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'name', name: 'name' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection