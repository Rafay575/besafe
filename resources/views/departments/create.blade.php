@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Create Department</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Create New Department</h6>
  </nav>
@endsection

@section('content')
<div class="row">
  <div class="col-12 mx-auto">
    <form action="{{ route('departments.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">

                  <div class="form-group col-md-3 @error('name') is-invalid @enderror">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Department Name">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group col-md-3">
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary w-100 mt-4 ">Create</button>
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


@push('js-script') 


  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

@endpush