@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Roles List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Roles List" page-desc="List of Roles" >
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4"> 
          <div class="ms-auto my-auto">
            <a href="{{route('roles.create')}}" class="btn bg-purple btn-sm mb-0" >+&nbsp; New Role</a>
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush table-striped" id="roles-table" data-source="{{route('roles.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Role Name,Action"></x-table.tblhead>
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
  const table = $('#roles-table');
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