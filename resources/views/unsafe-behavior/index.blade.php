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
            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="dataTable">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Unit,Department,Line,Location,Action"></x-table.tblhead>
              </thead>
              <tbody>
                <tr>
                  <td class="text-sm">1</td>
                  <td class="text-sm">Unit</td>
                  <td class="text-sm">Department</td>
                  <td class="text-sm">Line</td>
                  <td class="text-sm">Location</td>
                  <td class="text-sm">
                   <x-forms.action-btn href="" action="edit" title="edit unsafe-behavior"></x-forms.action-btn>
                   <x-forms.action-btn href="" action="view" title="view unsafe-behavior"></x-forms.action-btn>
                   <x-forms.action-btn href="" id="table_data_delete" action="delete" title="delete unsafe-behavior" data-action="{{route('unsafe-behaviors.destroy',1)}}"  data-parent="tr"></x-forms.action-btn>
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
