@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Show User">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('users.index')}}">Show User</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="View User" page-desc="View User Details">
        {{-- x-slot:pageheader referes to the second slot in one componenet --}}
        <x-slot:pageHeader>
          <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
              {{-- <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#recordCreate">+&nbsp; Add</a> --}}
            </div>
          </div>
        </x-slot>
        {{-- x slot page header ends here --}}

        {{-- default slot start here --}}
      <div class="row container">
        <div class="table-responsive col-6">
            <table class="table align-items-center mb-0 table-bordered">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <td>{{$user->id}}</td>
                  </tr>
                  <tr>
                    <th>First Name</th>
                    <td>{{$user->first_name}}</td>
                  </tr>
                  <tr>
                    <th>Last Name</th>
                    <td>{{$user->last_name}}</td>
                  </tr>
                  <tr>
                    <th>Mobile</th>
                    <td>{{$user->mobile}}</td>
                  </tr>
                  <tr>
                    <th>Role</th>
                    <td>{{$user->roles->pluck('name')}}</td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>{{$user->status ? "Active" : "InActive"}}</td>
                  </tr>
                  {{-- <tr>
                    <th>Image</th>
                    <td>{{$user->image}}</td>
                  </tr> --}}
                  <tr>
                    <th>Email</th>
                    <td>{{$user->email}}</td>
                  </tr>
                  <tr>
                    <th>Email Verified At</th>
                    <td>{{formatDate($user->email_verified_at)}}</td>
                  </tr>
                  <tr>
                    <th>Residential Address</th>
                    <td>{{$user->res_address}}</td>
                  </tr>
                  <tr>
                    <th>Permanent Address</th>
                    <td>{{$user->perm_address}}</td>
                  </tr>
                  <tr>
                    <th>Created At</th>
                    <td>{{formatDate($user->created_at)}}</td>
                  </tr>
                  <tr>
                    <th>Updated At</th>
                    <td>{{formatDate($user->updated_at)}}</td>
                  </tr>
                  <tr>
                    <th>Unit</th>
                    <td>{{$user->unit->unit_title ?? ""}}</td>
                  </tr>
                  <tr>
                    <th>Designation</th>
                    <td>{{$user->designation->designation_title ?? ""}}</td>
                  </tr>
                  <tr>
                    <th>Department</th>
                    <td>{{$user->department->department_title ?? ""}}</td>
                  </tr>
                  <tr>
                    <th>Line</th>
                    <td>{{$user->line->line_title ?? ""}}</td>
                  </tr>
                </tbody>
            </table>
            <button onclick="window.print()" class="btn btn-primary mt-5 d-print-none">Print</button>

        </div>
        <div class="other_info col-6">
        <img src="{{ (isset($user) && $user->image != "") ? asset('images/profile/' . $user->image) : asset('images/profile/User.ico') }}" class="img-fluid border-radius-lg shadow-lg max-height-500"  alt="avatar"><br>
        </div>
    </div>
</x-templates.basic-page-temp> 
@endsection
