@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="IE Audit Clause">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="IE Audit Clause" page-desc="List IE Audit Clause">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            <a href="{{route('ie_audits.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New IE Audit</a>
            {{-- <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button> --}}
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="table-responsive">
            <table class="table table-flush" id="ie-audits-table" data-source="{{route('ie_audits.index')}}">
              <thead class="thead-light">
                <x-table.tblhead heads="S.No,Audit Hall,Audit Type,Audit Date,Audit Score,Action"></x-table.tblhead>
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
  const table = $('#ie-audits-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'audit_hall', name: 'audit_hall' },
      { data: 'audit_type', name: 'audit_type' },
      { data: 'audit_date', name: 'audit_date' },
      { data: 'audit_score', name: 'audit_score' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
@endsection