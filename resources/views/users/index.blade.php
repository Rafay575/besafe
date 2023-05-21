@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Users List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Users List" page-desc="List of Registered Users">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            <a href="{{route('users.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New User</a>
            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="users-table" data-source ="{{route('users.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,First Name,Last Name,Email,Role,Status,Action"></x-table.tblhead>
              </thead>
              <tbody>
               
              </tbody>
              <tfoot>
                <x-table.tblhead heads="S.No,First Name,Last Name,Email,Role,Status,Action"></x-table.tblhead>
              </tfoot>
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
  const table  = $('#users-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'first_name', name: 'first_name' },
      { data: 'last_name', name: 'last_name' },
      { data: 'email', name: 'email' },
      { data: 'role', name: 'role' },
      { data: 'status', name: 'status' },
      { data: 'action', name: 'action', orderable: false, searchable: false },

    ],
    
  });
  
});
</script>
@endsection
