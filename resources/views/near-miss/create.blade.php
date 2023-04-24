@extends('layouts.main')
@section('breadcrumb')
<x-templates.breadcrumb page-title="Near-Miss Create">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('near-miss.index')}}">Near-Miss List</a></li>
</x-templates.breadcrumb>
@endsection

@section('content')
        @include('near-miss.partials.near_miss_create_form')
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