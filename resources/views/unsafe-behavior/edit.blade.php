@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="Add New Unsafe Behavior">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('unsafe-behaviors.index')}}">List of Unsafe Behavior</a></li>
</x-templates.bread-crumb>
@endsection

@section('content')
        <div class="row">
            <div class="col-12 col-lg-8  my-4">
              <div class="card">
                <div class="card-body">
                    @include('unsafe-behavior.partials.unsafe_behavior_form')
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-4 mx-auto my-4">
                <div class="card p-0">
                    <div class="card-body row">
                      <x-others.common-attach-view label="Attachments" :attachements="$unsafe_behavior->attachements"></x-others.common-attach-view>
                    </div>
                  </div>
            </div>
        </div>
@endsection
@section('script')

<script>
    // Dropzone initialization
    Dropzone.options.dropzone = {
        url: "{{ route('unsafe-behaviors.update',$unsafe_behavior->id) }}",
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 10,
        maxFilesize: 5, // in megabytes
        acceptedFiles: ".jpeg,.jpg,.png,.pdf", // allowed file types
        addRemoveLinks: true,
        dictRemoveFile: "Remove",
        dictInvalidFileType: "Invalid file type. Only JPEG, JPG, PNG, and PDF are allowed.",
        paramName: "attachements",
  
        init: function() {
            var submitButton = document.querySelector("#submit-button");
            var myDropzone = this; // Store Dropzone instance for later use
  
            // Set the CSRF token header for each file upload request
            myDropzone.on("sending", function(file, xhr, formData) {
            var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
            });

            submitButton.addEventListener("click", function(e) {
                // e.preventDefault();
                // e.stopPropagation();
                myDropzone.processQueue(); // Process the file queue
            });
  
            this.on("success", function(file, response) {
                // Handle successful file uploads
                console.log(response);
            });
  
            this.on("error", function(file, errorMessage) {
                // Handle file upload errors
                console.log(errorMessage);
            });
        }
    };
  </script>
  
@endsection