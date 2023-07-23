@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="View PTW">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('ptws.index')}}">List of PTW</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="View PTW" page-desc="View PTW Details">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
    <x-slot:pageHeader>
      <div class="ms-auto my-auto mt-lg-0 mt-4">
        <div class="ms-auto my-auto">
          {{-- <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#recordCreate">+&nbsp; Add</a> --}}
        </div>
      </div>
    </x-slot>
    {{-- x slot page header ends here --}}

    {{-- default slot start here --}}
  <div class="row container">
      {{-- right side --}}
    <div class="table-responsive col-8">
        <table class="table align-items-center mb-0 table-bordered col-12">
            <tbody>
                <tr>
                    <th>Initiated By</th>
                    <td>{{ $ptw->initiator->first_name }}</td>
                </tr>
                <tr>
                    <th>Start Time</th>
                    <td>{{ $ptw->start_time }}</td>
                </tr>
                <tr>
                    <th>End Time</th>
                    <td>{{ $ptw->end_time }}</td>
                </tr>
                <tr>
                    <th>Work Area</th>
                    <td>{{ $ptw->work_area }}</td>
                </tr>
                <tr>
                    <th>Line/Machine</th>
                    <td>{{ $ptw->line_machine }}</td>
                </tr>
                <tr>
                    <th>Is PTW Exist</th>
                    <td>{{ $ptw->is_ptw_exist ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>Cross Reference</th>
                    <td>{{ $ptw->cross_reference }}</td>
                </tr>
                <tr>
                    <th>MOC Required</th>
                    <td>{{ $ptw->moc_required ? 'Yes' : 'No' }}</td>
                </tr>
                <tr>
                    <th>MOC Title</th>
                    <td>{{ $ptw->moc_title }}</td>
                </tr>
                <tr>
                    <th>MOC Description</th>
                    <td>{{ $ptw->moc_desc }}</td>
                </tr>
                {{-- <tr>
                    <th>PTW Type</th>
                    <td>{{$ptw->meta_ptw_type_id ? $ptw->ptw_type->ptw_type_title : ''}}</td>
                </tr> --}}
                <tr>
                    <th>Working Group</th>
                    <td>{{ $ptw->working_group }}</td>
                </tr>
                <tr>
                    <th>Worker Name</th>
                    <td>{{ $ptw->worker_name }}</td>
                </tr>
                <tr>
                    <th>PTW Types</th>
                    <td>{{ $ptw->ptw_types ? $ptw->ptw_types->pluck('ptw_type_title')->implode(', ') : '' }}</td>
                </tr>
                {{-- <tr>
                    <th>PTW Item</th>
                    <td>{{ $ptw->ptw_items ? $ptw->ptw_items->pluck('ptw_item_title')->implode(', ') : '' }}</td>
                </tr> --}}
                <tr>
                    <th>Work Description</th>
                    <td>{{ $ptw->work_desc }}</td>
                </tr>
             
                <tr>
                    <th>Created At</th>
                    <td>{{ $ptw->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $ptw->updated_at }}</td>
                </tr>
            </tbody>
    
        </table>

        <button onclick="window.print()" class="btn btn-primary mt-5 d-print-none">Print</button>
    </div>



   
</div>
</x-templates.basic-page-temp>     
@endsection
@section('script')

@endsection

