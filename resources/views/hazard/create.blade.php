@extends('layouts.main')
@section('breadcrumb')
<x-templates.breadcrumb page-title="Add New Hazard">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('hazards.index')}}">List of Hazards</a></li>
</x-templates.breadcrumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto my-4">
              <div class="card">
                <div class="card-body">
                    <form action="" class="col-12 row dropzone ajax-form" id="dropzone">
                        <x-forms.selectoption name="unit" selectClass="form-control-sm" label="Unit" divClass="col-12 col-sm-6">
                            <option value="Value">Value 1</option>
                        </x-forms.selectoption>
                        <x-forms.basic-input label="Date" name="date" type="date" value="" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
                        <x-forms.basic-input label="Location" name="location" type="text" value="" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
                        <x-forms.radio-and-check-box-div name="risk_level" label="Risk Level" div-class="col-6">
                            <x-forms.radio-box width="col-2" radio-box-class="" name="risk_level" checked="false" label="A" value="A"></x-forms.radio-box>
                            <x-forms.radio-box width="col-2" radio-box-class="" name="risk_level" checked="false" label="B" value="B"></x-forms.radio-box>
                            <x-forms.radio-box width="col-2" radio-box-class="" name="risk_level" checked="false" label="C" value="C"></x-forms.radio-box>
                        </x-forms.radio-and-check-box-div>
                      <x-forms.selectoption name="department" selectClass="form-control-sm" label="Department" divClass="col-12 col-sm-6">
                            <option value="Value">Value 1</option>
                            <option value="Value">Value 1</option>
                        </x-forms.selectoption>
                        <x-forms.selectoption name="line" selectClass="form-control-sm" label="Line" divClass="col-12 col-sm-6">
                            <option value="Value">Value 1</option>
                        </x-forms.selectoption>
                        <x-forms.textarea label="Description" name="description"  width="col-6" text-area-class="" cols="" rows="3"></x-forms.textarea>
                        <x-forms.textarea label="Solution" name="solution"  width="col-6" text-area-class="" cols="" rows="3"></x-forms.textarea>

                          <x-forms.selectoption name="tag_assign" selectClass="form-control-sm" label="Tag Assign" divClass="col-12 col-sm-6">
                            <option value="Value">Tag 1</option>
                            <option value="Value">Tag 2</option>
                        </x-forms.selectoption>

                        <x-forms.basic-input label="Cost of Action" name="action_cost" type="number" value="" width="col-6" input-class="form-control-sm"></x-forms.basic-input>

                          <x-forms.selectoption name="status" selectClass="form-control-sm" label="Status" divClass="col-12 col-sm-6">
                            <option value="">Pending</option>
                            <option value="">Complete</option>
                            <option value="">In Progress</option>
                        </x-forms.selectoption>

                        <div class="fallback form-group mb-6">
                          <input name="file" type="file" multiple />
                        </div>

                        <x-forms.ajax-submit-btn div-class="col-12" btn-class="btn-sm btn-primary btn-ladda">Submit</x-forms.ajax-submit-btn>
                    </form>
                    
                </div>
              </div>
            </div>
        </div>
@endsection
@section('script')
<script src="{{asset('assets/js/plugins/dropzone.min.js')}}"></script>

<script>
          Dropzone.autoDiscover = false;
            var drop = document.getElementById('dropzone')
            // callback and crossOrigin are optional

            var myDropzone = new Dropzone(drop, {
            url: "/file/post",
            addRemoveLinks: true

      });
    //   let files = [
    //     { name: "another file", size: 1405, path:" {{asset('assets/img/automotive.jpg')}}" },
    //     { name: "another file", size: 145, path:" {{asset('assets/img/automotive.jpg')}}" },
    // ];
    // files.forEach(file => {
    //     const existingFile = {name:file.name,size:file.size}
    //     console.log(file);
    //     myDropzone.displayExistingFile(existingFile, file.path);
    // });
</script>
@endsection