@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Create Employee</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Create New Employee</h6>
  </nav>
@endsection

@section('content')
<div class="row">
  <div class="col-12 mx-auto">
    <form action="{{ route('employees.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">

                  <div class="form-group col-md-3 @error('name') is-invalid @enderror">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-3 @error('department_id') is-invalid @enderror">
                    <label for="department_id" class="form-control-label">Department</label>
                  <select class="form-control" name="department_id" id="department_id" >
                      @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-3 @error('designation_id') is-invalid @enderror">
                    <label for="designation_id" class="form-control-label">Designation</label>
                  <select class="form-control" name="designation_id" id="designation_id" >
                      @foreach($designations as $designations)
                        <option value="{{$designations->id}}">{{$designations->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-3 @error('mobile') is-invalid @enderror">
                    <label for="name">Mobile</label>
                    <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Mobile Number">
                    @error('mobile')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-2 @error('grade') is-invalid @enderror">
                    <label for="grade">Grade</label>
                    <input type="text" name="grade" class="form-control" id="grade" placeholder="Grade">
                    @error('grade')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-2 @error('employee_id') is-invalid @enderror">
                    <label for="name">Employee ID</label>
                    <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="Employee ID">
                    @error('employee_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-2 @error('roles') is-invalid @enderror">
                    <label for="roles" class="form-control-label">Role</label>
                  <select class="form-control" name="roles" id="roles" >
                      @foreach($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-2 @error('region_id') is-invalid @enderror">
                    <label for="region_id" class="form-control-label">Region</label>
                  <select class="form-control" name="region_id" id="region_id" >
                      @foreach($regions as $region)
                        <option value="{{$region->id}}">{{$region->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-2 @error('sub_region_id') is-invalid @enderror">
                    <label for="sub_region_id" class="form-control-label">Sub-Region</label>
                  <select class="form-control" name="sub_region_id" id="sub_region_id" >
                      @foreach($sub_regions as $sub_region)
                        <option value="{{$sub_region->id}}">{{$sub_region->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-2 @error('report_to') is-invalid @enderror">
                    <label for="report_to">Report To</label>
                    <input type="text" name="report_to" class="form-control" id="report_to" placeholder="Report To">
                    @error('report_to')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-3 @error('email') is-invalid @enderror">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email Address">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-3 @error('secondary_email') is-invalid @enderror">
                    <label for="secondary_email">Secondary Email (optional)</label>
                    <input type="text" name="secondary_email" class="form-control" id="secondary_email" placeholder="Secondary Email Address">
                    @error('secondary_email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-3 @error('profile_picture') is-invalid @enderror">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" name="image" class="form-control" id="profile_picture">
                    @error('profile_picture')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-3">
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary w-50 mt-4 ">Create</button>
                    </div>
                  </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection


@section('script') 

    <script type="text/javascript">
        document.getElementById("mobile").addEventListener("input", function() {
            var inputValue = this.value;
            console.log(inputValue);
            if (inputValue === "" || inputValue < 923) {
                this.value = "923";
            }
            if (inputValue.length > 12) {
                this.value = inputValue.slice(0, 12);
            }
        });
    </script>

<!--   <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script> -->

@endsection