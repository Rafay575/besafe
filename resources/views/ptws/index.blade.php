@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Permit to Work">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Permit to Work" page-desc="List Permissions to Work">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            <a href="{{route('ptws.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New PTW</a>
            {{-- <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button> --}}
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="ptws-table" data-source="{{route('ptws.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Start Time,End Time,Work Area,Moc Title,Worker Name,Action"></x-table.tblhead>
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
  const table = $('#ptws-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'start_time', name: 'start_time' },
      { data: 'end_time', name: 'end_time' },
      { data: 'work_area', name: 'work_area' },
      { data: 'moc_title', name: 'moc_title' },
      { data: 'worker_name', name: 'worker_name' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection