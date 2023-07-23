@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Hazard">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('hazards.index')}}">List of Hazards</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
@include('hazard.partials.hazard_create_form')
       
@endsection
@section('script')
  <script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>
  @include('partials.location_script')
@endsection

