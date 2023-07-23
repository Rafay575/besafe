@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Meta Data">
</x-templates.bread-crumb>
@endsection

@section('content')
<x-templates.basic-page-temp page-title="Meta Data" page-desc="Meta Data">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
    <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
                {{-- <a href="{{route('fire-property.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp;
                New damage</a> --}}
            </div>
        </div>
        </x-slot>
        {{-- x slot page header ends here --}}

        {{-- default slot starts here --}}
        <div class="row container">
          <div class="col-12 mb-5">

            @can('meta_data.create')
            <div class="accordion-item mb-3">
              <h5 class="accordion-header" id="headingOne">
                <button class="accordion-button border-bottom font-weight-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  Meta Data Excel Import
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
              </h5>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionRental" style="">
                <div class="accordion-body text-sm opacity-8">
                <form action="{{route('meta-data.excel.import')}}" method="post" class="ajax-form" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group col-6">
                    <label for="file">File</label>
                    <input type="file" name="file" class="form-control form-control-sm" required>
                  </div>
                  <div class="form-group col-6">
                  <input type="hidden" name="redirect" value="{{url()->current()}}">
                  <x-forms.ajax-submit-btn div-class="col-12"  id="submit-button" btn-class="btn-sm btn-primary btn-ladda">Submit</x-forms.ajax-submit-btn>
                  </div>
                </form>
                <a href="{{asset('excel_temp/meta_data_v3.xlsx')}}" class="link">Download Template</a>

              </div>
            </div>
            @endcan
          </div>
          </div>
        </div>
        @can('meta_data.create')
        <div class="row container mb-5">
            
           <x-verticle-nav-view>
            <x-slot:heads>
              @foreach ($menus as $menu)
                 <x-verticle-nav-link-view title="{{$menu}}"></x-verticle-nav-link-sview>
              @endforeach
            </x-slot:heads>

            <x-slot:contents>

            @foreach ($menus as $menu)
                  @php
                      $menu_slug = Str::slug($menu).'_table';
                      $menu_view = "meta-data.partials.index.{$menu_slug}";
                  @endphp
                  <x-verticle-nav-content-view title="{{$menu}}">
                      @include($menu_view)    
                  </x-verticle-nav-content-sview>
              @endforeach
              
            </x-slot:contents>
           </x-verticle-nav-view>
        </div>
        @endcan

        {{-- defautl slot end here --}}

</x-templates.basic-page-temp>


{{-- Meta Data Create modals --}}
<x-modals.basic-modal title="Meta Data Create" id="metaDataCreate" footer="no" header="yes" class="modal fade modal-md">
  <form method="POST" class="ajax-form row" id="meta_data_add_form"  action="{{route('meta-data.store')}}">
    @csrf
      <div class="col-12 col-sm-6 form-group" id="title_field">
          <label for="title" class="col_form_label">Title</label>
          <input type="text" class="form-control form-control-sm" name="title_field_place_holder" value="" id="title_field" required>
      </div>
    <div class="col-12 col-sm-6 form-group" id="group_name">
      <label for="group_name" class="col_form_label">Group Name</label>
      <input type="text" class="form-control form-control-sm" name="group_name" value="" id="group_name">
    </div>
    <input type="hidden" name="meta_data_name" id="meta_data_name" value="">
    {{-- <input type="hidden" name="meta_data_id" id="meta_data_id" value=""> --}}
    <div class="col-12 form-group">
      <input type="hidden" name="redirect" value="{{url()->current()}}">
      <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" type="submit" id="submit-button" title="Send" data-style="expand-left">Submit</button>
    </div>
  </form>
</x-modals.basic-modal>
<!-- Modal -->
{{-- Meta Data Edit modals --}}
<x-modals.basic-modal title="Meta Data Edit" id="metaDataEdit" footer="no" header="yes" class="modal fade modal-md">
  <form method="POST" class="ajax-form row" id="meta_data_edit_form"  action="{{route('meta-data.store')}}">
    @csrf
      <div class="col-12 col-sm-6 form-group" id="title_field">
          <label for="title" class="col_form_label">Title</label>
          <input type="text" class="form-control form-control-sm" name="title_field_place_holder" value="" id="title_field" required>
      </div>
    <div class="col-12 col-sm-6 form-group" id="group_name">
      <label for="group_name" class="col_form_label">Group Name</label>
      <input type="text" class="form-control form-control-sm" name="group_name" value="" id="group_name">
    </div>
    <input type="hidden" name="meta_data_name" id="meta_data_name" value="">
    <input type="hidden" name="meta_data_id" id="meta_data_id" value="">
    <div class="col-12 form-group">
      <input type="hidden" name="redirect" value="{{url()->current()}}">
      <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" type="submit" id="submit-button" title="Send" data-style="expand-left">Submit</button>
    </div>
  </form>
</x-modals.basic-modal>
<!-- Modal -->


@endsection

@section('script')
<script>

const table = $('.datatable');
  table.DataTable({
    serverSide: false,
  });

  $('#submit-button').on('click', function() {
  history.replaceState({}, document.title, window.location.pathname);
});


    // Get the URL fragment
    var urlFragment = window.location.hash;
    // Check if the URL fragment matches your parameter
    if (urlFragment === '') {
      // Add the "active" class to the corresponding div.nav element
      $('a.departments').addClass('active');
      $('div.departments').addClass('active');
    }else{
      let divSelector = "div" + urlFragment.replace(/#/g, '.');
      let aSelector = "a" + urlFragment.replace(/#/g, '.');
      $(divSelector).addClass('active');
      $(aSelector).addClass('active');
    }

  // creation of new meta data
  $('body').on('click','a#meta_data_add_button',function(e){
    resetForms();
     let meta_data_name = $(this).attr('data-meta_data_name');
     let title_field = $(this).attr('data-title_field');
     $('input#meta_data_name').val(meta_data_name);
     // Set the name attribute of the title field
      $('input#title_field').attr('name', title_field);
      if (meta_data_name === "ie_audit_questions") {
        // setIEAuditQuestionAuditTypeInput({name:'test',value:'haha'});
        setIEAuditQuestionAuditTypeInput();
      }

      if (meta_data_name === "risk_levels") {
        // setRiskLevelDayRequiredInput(5);
        setRiskLevelDayRequiredInput();
      }
      if (meta_data_name === "locations") {
        // setRiskLevelDayRequiredInput(5);
        setLocationsRequiredInput();
      }


  });

  // updation of meta data
  
   $('body').on('click','i#meta_data_edit_button',function(e){
    e.preventDefault();
    resetForms();
     let meta_data_obj = $(this).attr('data-meta_data_obj');
     let parsed_obj = JSON.parse(meta_data_obj);
     let meta_data_name = $(this).attr('data-meta_data_name');     
     let title_field = $(this).attr('data-title_field');
     $('input#meta_data_name').val(meta_data_name);
     $('input#meta_data_id').val(parsed_obj['id']);
     // Set the name attribute of the title field
      $('input#title_field').val(parsed_obj[title_field]);
      $('input#title_field').attr('name', title_field);
      $('input#group_name').val(parsed_obj['group_name']);

      if (meta_data_name === "ie_audit_questions") {
        setIEAuditQuestionAuditTypeInput(parsed_obj);
      }

      if (meta_data_name === "risk_levels") {
        setRiskLevelDayRequiredInput(parsed_obj);
      }
      if (meta_data_name === "locations") {
        // setRiskLevelDayRequiredInput(5);
        setLocationsRequiredInput(parsed_obj);
      }


  });


  function resetForms(){
    $('input#meta_data_id').val("");
    $('input#meta_incident_name').val("");
    $('form#meta_data_edit_form').trigger('reset');
    $('form#meta_data_add_form').trigger('reset');
    $('div#days_required').remove();
    $('div#meta_audit_type_id').remove();
  }







  function setIEAuditQuestionAuditTypeInput(defaultValue = null) {
    let div = '<div class="col-12 col-sm-6 form-group" id="meta_audit_type_id"><label for="meta_audit_type_id" class="col_form_label">Audit Type</label><select class="form-control form-control-sm" name="meta_audit_type_id" id="meta_audit_type_id" required>';
    if (defaultValue != undefined) {
      let name = "select";
      let value = defaultValue['meta_audit_type_id'];
      div += '<option selected value="' + value + '">' + name + '</option>';
    }
    @foreach ($auditTypes as $auditType)
    div += '<option value="{{ $auditType->id }}">{{ $auditType->audit_title }}</option>';
    @endforeach
    div += '</select></div>';
    $('div#group_name').after(div);
}

function setRiskLevelDayRequiredInput(defaultValue = {}){
  let value = "";
  if(defaultValue != ""){
    value = defaultValue['days_required'];
  }
  // Create a new div
  let div = '<div class="col-12 col-sm-6 form-group" id="days_required"><label for="days_required" class="col_form_label">Days Required</label><input type="number" value="' + value + '" class="form-control form-control-sm" name="days_required" id="days_required" required/></div>';
  $('div#group_name').after(div);
  
}
function setLocationsRequiredInput(defaultValue = {}) {
  let value = "";
  let selected = "";
  if (defaultValue !== "") {
    value = defaultValue['meta_unit_id'];
  }

  // Create a new div
  let locationDiv = `<div class="col-12 col-sm-6 form-group" id="meta_unit_id_for_location"></div>`;
  let selectLocation = `<label for="meta_unit_id" class="col_form_label">Unit Title</label><select name="meta_unit_id" id="meta_unit_id_for_location" class="form-control form-control-sm">`;

  // Append options to the select element
  @foreach ($units as $unit)
    selectLocation += `<option value="{{$unit->id}}" ${value == {{$unit->id}} ? 'selected' : ''}>{{$unit->unit_title}}</option>`;
  @endforeach

  selectLocation += `</select>`;
  $('div#group_name').after(locationDiv);
  $('div#meta_unit_id_for_location').empty().append(selectLocation);
  $('div#group_name').remove();
}


</script>
@endsection
