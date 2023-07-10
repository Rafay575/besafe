@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Audit Reporting">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('ie_audits.index')}}">List of Audit</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 col-lg-12 mx-auto my-4">
              <div class="card">
                <div class="card-body">
                  @canany(['ie_audit_cluase.view', 'ie_audit_cluase.edit'])
                  @include('ie_audits.partials.audit_init_show')
                      
                  @endcanany
                </div>
              </div>
            </div>
        </div>
@endsection
@section('script')

<script>

</script>
@endsection