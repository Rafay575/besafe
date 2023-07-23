@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Unsafe Behavior">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('unsafe-behaviors.index')}}">List of Unsafe Behavior</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 my-4">
                    @include('unsafe-behavior.partials.unsafe_behavior_form')
            </div>
            <div class="col-12 col-sm-8 mx-auto my-4">
                <div class="card p-0">
                    <div class="card-body row">
                      <x-others.common-attach-view label="Initial_Attachments" :attachements="$unsafe_behavior->initial_attachements" shouldDelete="true"></x-others.common-attach-view>
                      <x-others.common-attach-view label="Attachments" :attachements="$unsafe_behavior->attachements" shouldDelete="true"></x-others.common-attach-view>
                    </div>
                  </div>
            </div>
        </div>
@endsection
@section('script')

<script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>

@include('partials.location_script')
  
@endsection