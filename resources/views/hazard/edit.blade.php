@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Hazard">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('hazards.index')}}">List of Hazards</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-4">
              <div class="card">
                <div class="card-body">
                    @include('hazard.partials.hazard_create_form')
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-4 mx-auto my-4">
                <div class="card p-0">
                    <div class="card-body row">
                      <x-others.common-attach-view label="Attachments" :attachements="$hazard->attachements" shouldDelete="true"></x-others.common-attach-view>
                    </div>
                  </div>
            </div>

        </div>
@endsection
@section('script')

<script>
  // Dropzone initialization
  Dropzone.options.dropzone = {
    ...DropzoneConfig,
    url: "{{ route('hazards.update',$hazard->id) }}",
    paramName: "attachements",
    shouldFormReset: false
  };
</script>
@endsection