@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Audit">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('ie_audits.index')}}">List of Audit</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 col-lg-12 mx-auto my-4">
              <div class="card">
                <div class="card-body">
                    @include('ie_audits.partials.audit_init_show')
                </div>
              </div>
            </div>
        </div>
@endsection
@section('script')

<script>

</script>
@endsection