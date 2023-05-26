@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Unsafe Behavior">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('unsafe-behaviors.index')}}">List of Unsafe Behavior</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-4">
              <div class="card">
                <div class="card-body">
                    @include('unsafe-behavior.partials.unsafe_behavior_form')
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
    paramName: "attachements",
    url: "{{ route('unsafe-behaviors.store') }}",
  };
</script>
@endsection