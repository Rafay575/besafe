@extends('layouts.main')
@can('dashboard.view')

  @section('breadcrumb')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm">
      <a class="text-white" href="javascript:;">
      <i class="ni ni-box-2"></i>
      </a>
    </li>
    <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white"
      href="javascript:;">Dashoard</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Dashboard</h6>
  </nav>
  @endsection
  @section('content')
  @include('dashboard.partials.top_stats')
  @if ($userType === 'employee')
    @include('dashboard.partials.employee')
   
  @else
  @include('dashboard.partials.line_graph')
  @include('dashboard.partials.recent_table')
    @include('dashboard.partials.dounut_graph')
    @include('dashboard.partials.bottom_table')
  @endif





  @endsection
@endcan

@section('script')

<script src="{{ asset('assets/js/chart.js') }}"></script>

@endsection