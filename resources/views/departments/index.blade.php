@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Department List</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Department List</h6>
  </nav>
@endsection

@section('content')

<div class="row ">
    <div class="col-12 ">
      <div class="card bg-white-custom lightborder-unique shadow-lg">

        <div class="card-header bg-white-custom  pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Departments</h5>
                <p class="text-sm mb-0">
                 List of Departments
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                @can('adminsetting.create')    
                  <div class="ms-auto my-auto">
                    <a href="{{route('departments.create')}}" class="btn bg-purple btn-sm mb-0" >+&nbsp; Add New</a>
                  </div>
                @endcan
              </div>
            </div>
        </div>

        <div class="table-responsive"style="border-collapse: collapse; border-spacing: 0; width: 95%; margin-left: 2%;">
          <table class="table table-flush dataTable no-footer table-striped" id="departments-table">
            <thead class="thead-light">
              <tr>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($departments as $department)
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    {{$department->name}}
                  </div>
                </td>

                <td>
                   <div style="width: 10%;">
                     
                    <a 
                        href="{{route('departments.edit', $department->id)}}" 
                        class="mx-2" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="edit unsafe behavior" 
                        data-container="body" 
                        data-animation="true" 
                        data-bs-original-title="edit unsafe behavior"
                      >
                      <i class="fas fa-user-edit text-purple"></i>
                    </a>

                    <form action="{{route('departments.destroy', $department->id)}}" method="post" style="float:right;">
                      <input type="hidden" name="_method" value="DELETE">
                      @csrf
                         <button id="btnDelete" onclick="return confirm('Are you sure?')"  class="btn shadow-none" style="padding: 0px 0px;"><i class="fas fa-trash text-danger"></i></button>
                             
                    </form>
                   </div> 
                </td>

              @endforeach
            </tbody>
          </table>
        </div>

    </div>
  </div>
</div>




@endsection

@section('style')

  <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap.css" rel="stylesheet" />

@endsection


@section('script')

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap.js"></script>

<script>

    $( document ).ready(function() {
        new DataTable('#departments-table');
    });


 </script>

@endsection