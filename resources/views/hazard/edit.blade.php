@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Hazard">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('hazards.index')}}">List of Hazards</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12  mx-auto my-4">
              @include('hazard.partials.hazard_create_form')
            </div>

            <div class="col-12 col-sm-8 mx-auto my-4">
                <div class="card p-0">
                    <div class="card-body row">
                      <x-others.common-attach-view label="Initial_Attachments" :attachements="$hazard->initial_attachements" shouldDelete="true"></x-others.common-attach-view>
                      <x-others.common-attach-view label="Attachments" :attachements="$hazard->attachements" shouldDelete="true"></x-others.common-attach-view>
                    </div>
                  </div>
            </div>

        </div>
@endsection
@section('script')


<script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>

@include('partials.location_script')
@endsection