@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Unsafe Behavior">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('unsafe-behaviors.index')}}">List of Unsafe Behavior</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
@include('unsafe-behavior.partials.unsafe_behavior_form')
        
@endsection
@section('script')

<script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>

@include('partials.location_script')

@endsection