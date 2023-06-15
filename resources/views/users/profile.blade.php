@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Show User Profile">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('users.index')}}">Show User Profile</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
@php
    $user = auth()->user();
@endphp
<x-templates.basic-page-temp page-title="View User Profile" page-desc="View User Details">
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
        <div class="col-12 col-sm-8">
            <form class="row ajax-form" action="{{ route('users.profileStore') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row mt-3">
                    <x-forms.basic-input label="First Name" name="first_name" type="text" placeholder="eg. Ali" value="{{ isset($user) ? $user->first_name : '' }}" width="col-12 col-sm-6" input-class="" required></x-forms.basic-input>
                    <x-forms.basic-input label="Last Name" name="last_name" type="text" placeholder="eg. Zeb" value="{{ isset($user) ? $user->last_name : '' }}" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="" required></x-forms.basic-input>
                  </div>
                  <div class="row mt-3">
                    <x-forms.basic-input label="Mobile" name="mobile" type="text" placeholder="eg. xxx-xxxxxxx" patterns="\d{3}-?\d{2}-?\d{4}" value="{{ isset($user) ? $user->mobile : '' }}" width="col-12 col-sm-6" input-class="" required></x-forms.basic-input>
                    <x-forms.basic-input label="Email" name="email" type="email" placeholder="eg. ali.zeb@gmail.com" value="{{ isset($user) ? $user->email : '' }}" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class=""></x-forms.basic-input>
                  </div>

                  <div class="row mt-3">
                      <x-forms.text-area label="Permanent Address" name="perm_address" width="col-12" text-area-class="" cols="2" rows="2">{{ isset($user) ? $user->perm_address : '' }}</x-forms.text-area>
                      <x-forms.text-area label="Residential Address" name="res_address" width="col-12" text-area-class="" cols="2" rows="2">{{ isset($user) ? $user->res_address : '' }}</x-forms.text-area>
                      <x-forms.basic-input label="Password" name="password" type="password" placeholder="password" value="" width="col-6" input-class="" :required="!isset($user)"></x-forms.basic-input>
                      <x-forms.basic-input label="Confirm Password" name="password_confirmation" type="password" placeholder="confirm password" value="" width="col-6" input-class="" :required="!isset($user)"></x-forms.basic-input>
                      <x-forms.basic-input label="" name="image" type="file" placeholder="" value="" width="col-12" input-class=""></x-forms.basic-input>
                  </div>

                 <div class="row mt-3 mb-5">
                    <div class="col-2">
                        <input type="hidden" name="redirect" value="{{url()->previous()}}">
                        <button class="btn bg-gradient-primary mb-0 btn-ladda" type="submit" title="Send" data-style="expand-left">Update</button>
                    </div>
                </div> 
            </form>   

        </div>
        <div class="other_info col-4">
        <img src="{{ (isset($user) && $user->image != "") ? asset('images/profile/' . $user->image) : asset('images/profile/User.ico') }}" class="img-fluid border-radius-lg shadow-lg max-height-500"  alt="avatar"><br>
        </div>
    </div>
</x-templates.basic-page-temp> 
@endsection
