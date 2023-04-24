@extends('layouts.main')
@section('breadcrumb')
<x-templates.breadcrumb page-title="User Create">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('users.index')}}">Users List</a></li>
</x-templates.breadcrumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="Users List" page-desc="List of Registered Users">
        {{-- x-slot:pageheader referes to the second slot in one componenet --}}
        <x-slot:pageHeader>
          <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
            </div>
          </div>
        </x-slot>
        {{-- x slot page header ends here --}}
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-4">
              <div class="card">
                <div class="card-body">

                    
                </div>
              </div>
            </div>
        </div>
</x-templates.basic-page-temp> 
@endsection
@section('script')
@endsection