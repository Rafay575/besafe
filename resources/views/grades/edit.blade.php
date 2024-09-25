@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Edit Grade</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Edit Grade</h6>
  </nav>
@endsection

@section('content')
<div class="row">
  <div class="col-12 mx-auto">
      <form action="{{ route('grades.update',$grade->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="put">
         <div class="row">
          <div class="col-12">
            <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-3 @error('name') is-invalid @enderror">
                          <label for="name">Name</label>
                          <input type="text" name="name" class="form-control" id="name" value="{{$grade->name}}"  placeholder="Designation Name">
                          @error('name')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group col-md-3 @error('code') is-invalid @enderror">
                          <label for="name">Code</label>
                          <input type="text" name="code" class="form-control" id="name" value="{{$grade->code}}"  placeholder="Code">
                          @error('code')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                        </div>   

                        <div class="form-group col-md-4">
                          <label for="name">Description</label>
                          <textarea  name="description" class="form-control" id="description">{{$grade->description}}</textarea>
                        </div>

                        <div class="form-group col-md-2">
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 mt-4 ">Update</button>
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