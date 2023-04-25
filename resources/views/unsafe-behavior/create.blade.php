@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Unsafe Behavior">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('unsafe-behaviors.index')}}">List of Unsafe Behavior</a></li>
</x-templates.bread-crumb>
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
                        <x-forms.selectoption name="department" selectClass="form-control-sm" label="Department" divClass="col-12 col-sm-6">
                            <option value="Value">Value 1</option>
                        </x-forms.selectoption>
                        <x-forms.selectoption name="line" selectClass="form-control-sm" label="Line" divClass="col-12 col-sm-6">
                            <option value="Value">Value 1</option>
                        </x-forms.selectoption>
                        <x-forms.basic-input label="Location" name="location" type="text" value="" width="col-6" input-class="form-control-lg"></x-forms.basic-input>
                        <x-forms.textarea label="Details of Unsafe Behavior" name="details"  width="col-6" text-area-class="" cols="" rows="3"></x-forms.textarea>

                        <x-forms.selectoption name="type" multiple selectClass="form-control-sm" label="Type of Unsafe Behavior" divClass="col-12 col-sm-6">
                            <option value="Value">Value 1</option>
                            <option value="Value">Value 2</option>
                        </x-forms.selectoption>
                        <x-forms.selectoption name="type" multiple selectClass="form-control-sm" label="Type of Unsafe Behavior" divClass="col-12 col-sm-6">
                            <option value="Value">Value 1</option>
                            <option value="Value">Value 2</option>
                        </x-forms.selectoption>
                        <div class="fallback col-6 form-group mb-6">
                            <input name="file" type="file" multiple />
                          </div>
                          <div class="form-group col-6">
                            <button class="btn btn-sm btn-primary btn-ladda">Submit</button>
                          </div>
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
      let files = [
        { name: "another file", size: 1405, path:" {{asset('assets/img/automotive.jpg')}}" },
        { name: "another file", size: 145, path:" {{asset('assets/img/automotive.jpg')}}" },
    ];
    files.forEach(file => {
        const existingFile = {name:file.name,size:file.size}
        console.log(file);
        myDropzone.displayExistingFile(existingFile, file.path);
    });
</script>
@endsection