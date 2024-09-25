@extends('layouts.main')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Business Hours</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Business Hours</h6>
  </nav>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Business Hours</h5>
                <p class="text-sm mb-0">
                 Business Hours
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                @can('adminsetting.create')    
                  @if(isset($businesshours->id))
                    <div class="ms-auto my-auto">
                      <a href="{{route('businesshours.edit', $businesshours->id)}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Update business hours</a>
                    </div>
                  @else
                    <div class="ms-auto my-auto">
                      <a href="{{route('businesshours.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Add business hours</a>
                    </div>
                  @endif
                @endcan
              </div>
            </div>
        </div>

        @if(isset($businesshours->id))
        <div class="row">
          <div class="col-12 mb-4">
            <div class="container mt-5">
                <div class="card mt-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1">{{$businesshours->name}} <i class="bi bi-lock"></i></h5>
                            <p class="card-text text-muted mb-0">{{$businesshours->timezone}}</p>
                        </div>
                        <!-- 
                        <div>
                            <button class="btn btn-link text-dark p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
          </div>
        </div>
        @endif



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