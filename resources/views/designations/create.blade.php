@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Designation">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('designations.index')}}">List of Designations</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
  <div class="container-fluid py-4">
    <form action="{{ route('designations.store') }}" method="POST">
    @csrf
       <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="card-body">
                  <div class="row">
                      <div class="form-group col-md-3 @error('name') is-invalid @enderror">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Designation Name">
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