@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Injury">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('injuries.index')}}">Injruies List</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        @include('injuries.partials.injury_form');
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