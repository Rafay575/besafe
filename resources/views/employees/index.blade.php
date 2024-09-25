@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Employees List</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Employees List</h6>
  </nav>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card bg-white-custom lightborder-unique shadow-lg">

        <div class="card-header bg-white-custom pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Employees</h5>
                <p class="text-sm mb-0">
                 List of Employees
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                  <a href="{{route('employees.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Add New</a>
                </div>
                <!-- @can('unsafe_behavior.create')     -->
                <!-- @endcan -->
              </div>
            </div>
        </div>

        <div class="table-responsive"style="border-collapse: collapse; border-spacing: 0; width: 95%; margin-left: 2%;">
          <table class="table table-flush dataTable no-footer table-striped" id="employees-table">
            <thead class="thead-light">
              <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
              <tr>
                <td>
                    <div class="d-flex align-items-center">
                      {{$employee->employee_id}}
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      {{$employee->name}}
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      {{$employee->email}}
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      {{$employee->user->roles->pluck('name')->first()}}
                    </div>
                </td>                                
                <td>
                   <div style="width: 40%;">
                     
                    <a 
                        href="{{route('employees.edit', $employee->id)}}" 
                        class="mx-2" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="edit employee" 
                        data-container="body" 
                        data-animation="true" 
                        data-bs-original-title="edit employee"
                      >
                      <i class="fas fa-user-edit text-purple"></i>
                    </a>

                    <form action="{{route('employees.destroy', $employee->id)}}" method="post" style="float:right;">
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
        new DataTable('#users-table');
    });


 </script>

@endsection


<!-- admin Muhammad Yousaf 03027794612
DELETE FROM users WHERE id != 4, 21,30;
-->