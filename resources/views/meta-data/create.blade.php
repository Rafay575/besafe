@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add Meta Data">
  {{-- <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('ptws.index')}}">List of PTWS</a></li> --}}
</x-templates.bread-crumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-4">
              <div class="card">
                <div class="card-body">
                    @include('meta-data.partials.meta_data_create_form')
                </div>
              </div>
            </div>
        </div>
@endsection
@section('script')

<script>

</script>
@endsection