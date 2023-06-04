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
        {{-- defautl slot end here --}}

</x-templates.basic-page-temp>


{{-- modals --}}
<x-modals.basic-modal title="Meta Data Create" id="metaDataCreate" footer="no" header="yes" class="modal fade modal-md">
  <form method="POST" class="ajax-form row"  action="{{route('meta-data.store')}}">
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
      <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" type="submit" title="Send" data-style="expand-left">Submit</button>
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

  $('body').on('click','a#meta_data_add_button',function(e){
     let meta_data_name = $(this).attr('data-meta_data_name');
     let title_field = $(this).attr('data-title_field');
     let desc_field = $(this).attr('data-desc_field');
     $('input#meta_data_name').val(meta_data_name);
     // Set the name attribute of the title field
      $('input#title_field').attr('name', title_field);

      if (meta_data_name === "ie_audit_questions") {
         let div = '<div class="col-12 col-sm-6 form-group" id="meta_audit_type_id"><label for="meta_audit_type_id" class="col_form_label">Audit Type</label><select class="form-control form-control-sm" name="meta_audit_type_id" id="meta_audit_type_id" required>';
          @foreach ($auditTypes as $auditType)
            div += '<option value="{{ $auditType->id }}">{{ $auditType->audit_title }}</option>';
          @endforeach

          div += '</select></div>';

          $('div#group_name').after(div);
      }

      if (meta_data_name === "risk_levels") {
         let div = '<div class="col-12 col-sm-6 form-group" id="days_required"><label for="days_required" class="col_form_label">Days Required</label><input type="number" class="form-control form-control-sm" name="days_required" id="days_required" required/></div>';
          $('div#group_name').after(div);
      }


  });
  

</script>
@endsection
