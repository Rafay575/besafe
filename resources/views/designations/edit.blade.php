@extends('layouts.main')

@section('page-title')
    {{__('Employee Create')}}
@endsection

@section('action-bar')
  <div class="d-sm-flex justify-content-between">
    <div>
      <a href="{{route('designations.index')}}" class="btn btn-icon btn-outline-white">
        Back
      </a>
    </div>
  </div>
@endsection

@section('content')
  <div class="container-fluid py-4">
    <form action="{{ route('designations.update',$designation->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="put">
       <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="card-body">
                  <div class="row">
                      <div class="form-group col-md-3 @error('name') is-invalid @enderror">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$designation->name}}"  placeholder="Designation Name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
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