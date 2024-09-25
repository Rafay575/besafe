@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Blank Page">
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="Blank Page Title" page-desc="Blank page for template">
      {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          <div class="ms-auto my-auto">
            <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#recordCreate">+&nbsp; Add</a>
            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
          </div>
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}
      {{-- Data Table --}}
      <div class="table-responsive">
        <table class="table table-flush table-striped" id="dataTable">
          <thead class="thead-light">
            <x-table.tblhead heads="Name,Username,Email,Role,Status,Action"></x-table.tblhead>
          </thead>
          <tbody>
            <tr>
              <td class="text-sm">
                <div class="d-flex px-2 py-1">
                    <div>
                      <img src="assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="avatar image">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Kashif Khan</h6>
                    </div>
                  </div>
                </td>
              <td class="text-sm">kashifbmk</td>
              <td class="text-sm">smevkpathan@gmail.com</td>
              <td class="text-sm">Admin</td>
              <td>
                <x-others.status status="1"></x-others.status>
              </td>
              <td class="text-sm">
               <x-forms.action-btn href="" action="edit" title="edit user"></x-forms.action-btn>
               <x-forms.action-btn href="" action="view" title="view user"></x-forms.action-btn>
               <x-forms.action-btn href="" action="delete" title="delete user"></x-forms.action-btn>
              </td>
            </tr>
          </tbody>
          
        </table>
    </div>
    {{-- Data Table end here --}}

    {{-- forms --}}

    <x-forms.basic-input label="Email Address" name="user_email" type="number" value="email address" width="col-4" input-class="form-control-lg"></x-forms.basic-input>
    <x-forms.check-box label="Email Address" name="user_email"  value="email address" width="col-6" check-box-class="" checked="false"></x-forms.check-box>
    <x-forms.toggle-check label="Email Address" name="user_email"  value="email address" width="col-6" check-box-class="" checked="true"></x-forms.toggle-check>
    <x-forms.radio-box label="Email Address" name="user_email"  value="" width="col-6" radio-box-class="" checked="true" disabled></x-forms.radio-box>  
    <x-forms.text-area label="Email Address" name="user_email"  width="col-12" text-area-class="" cols="10" rows="10">Something here</x-forms.text-area>
  <x-forms.dropdown id="mydorpdown" btnClass="bg-gradient-primary btn-sm" label="Actions" >
    <li><a class="dropdown-item" href="ahah">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </x-forms.dropdown>

  <x-forms.select-option name="name" selectClass="form-control-sm" label="Names">
    <option value="Choice 2">Bucharest</option>
    <option value="Choice 3">London</option>
    <option value="Choice 4">USA</option>
  </x-forms.select-option>

  {{-- fomrs end here --}}
</x-templates.basic-page-temp>
@endsection
@section('script')
    
@endsection