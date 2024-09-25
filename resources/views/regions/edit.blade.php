@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Edit Region</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Edit Region</h6>
  </nav>
@endsection

@section('content')
<div class="row">
  <div class="col-12 mx-auto">
      <form action="{{ route('regions.update',$region->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="put">
         <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">

                    <div class="form-group col-md-3 @error('name') is-invalid @enderror">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" id="name" value="{{$region->name}}" placeholder="Region Name">
                      @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group col-md-3 @error('p_region_id') is-invalid @enderror">
                      <label for="Parent Region" class="form-control-label">Parent Region</label>
                    <select class="form-control" name="p_region_id" id="p_region_id" >
                        <option value="">Main Region</option>
                        @foreach($p_regions as $p_region)
                          <option {{$region->p_region_id == $p_region->id ? "selected" : ""}} value="{{$p_region->id}}">{{$p_region->name}}</option>
                        @endforeach
                      </select>
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