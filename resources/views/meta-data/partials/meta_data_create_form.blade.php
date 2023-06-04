{{-- @if (isset($ptw))
<form action="{{route('ptws.update',$ptw->id)}}" class="col-12 row  ajax-form" method="post"  enctype="multipart/form-data">
@method('put')
 @else --}}
<form action="{{route('meta-data.store',$meta_data_name)}}" class="col-12 row  ajaxs-form" method="post"  enctype="multipart/form-data">
{{-- @endif --}}
    @csrf

    <x-forms.basic-input label="Title" name="title" type="text" value="" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
    
     <input type="hidden" name="redirect" value="{{url()->previous()}}">
    <x-forms.ajax-submit-btn div-class="col-12"  id="submit-button" btn-class="btn-sm btn-primary btn-ladda">Submit</x-forms.ajax-submit-btn>
</form>