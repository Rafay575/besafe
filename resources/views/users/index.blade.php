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
            <table class="table table-flush" id="dataTable">
              <thead class="thead-light">
                <x-table.tblhead heads="Name,Username,Email,Role,Status,Action"></x-table.tblhead>
              </thead>
              <tbody>
                <tr>
                  <td class="text-sm">
                    <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{asset('assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3" alt="avatar image">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">Kashif Khan</h6>
                        </div>
                      </div>
                    </td>
                  <td class="text-sm">kashifbmk</td>
                  <td class="text-sm">smevkpathan@gmail.com</td>
                  <td class="text-sm">Admin</td>
                  <td>
                    <x-others.status status="1"></x-others.status>
                  </td>
                  <td class="text-sm">
                   <x-forms.action-btn href="" action="edit" title="edit user"></x-forms.action-btn>
                   <x-forms.action-btn href="" action="view" title="view user"></x-forms.action-btn>
                   <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete user" data-action="{{route('users.destroy',1)}}"  data-parent="tr"></x-forms.action-btn>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <x-table.tblhead heads="Name,Username,Email,Role,Status,Action"></x-table.tblhead>
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
