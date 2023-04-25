@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Fire / Property Demage Create">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('fire-property.index')}}">Fire / Property Demage List</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        @include('fire-property.partials.fire_property_new_form')
@endsection
@section('script')
<script src="{{asset('assets/js/plugins/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>

<script>
          Dropzone.autoDiscover = true;
            var drop = document.getElementById('dropzone')
            // callback and crossOrigin are optional

            var myDropzone = new Dropzone(drop, {
            url: "/file/post",
            addRemoveLinks: true
             });
</script>   
@endsection