@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Fire and Property Demage List">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Fire and Property Demage List" page-desc="List of Fire and Property Demage">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            <a href="{{route('fire-property.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New Demage</a>
            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="dataTable">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Date,Reference,Unit,Location,Action"></x-table.tblhead>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <x-table.tblhead heads="S.No,Date,Reference,Unit,Location,Action"></x-table.tblhead>
              </tfoot>
            </table>
        </div>
      {{-- defautl slot end here --}}

   </x-templates.basic-page-temp>

@endsection
