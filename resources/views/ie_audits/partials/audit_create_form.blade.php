@if (isset($ptw))
<form action="{{route('ie_audits.update',$ie_audit->id)}}" class="col-12 row  ajax-form" method="post"  enctype="multipart/form-data">
@method('put')
 @else
<form action="{{route('ie_audits.store')}}" class="col-12 row  ajax-form" method="post"  enctype="multipart/form-data">
@endif
    @csrf

    <x-forms.basic-input label="Date Audit" name="audit_date" type="date" value="{{(isset($ie_audit) ? Carbon\Carbon::parse($ie_audit->date)->format('Y-m-d') : '')}}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>

    <x-forms.select-option name="meta_audit_hall_id" selectClass="form-control-sm" label="Audit Hall" divClass="col-12 col-sm-6" required>
        @foreach ($audit_halls  as $audit_hall)
        <option value="{{ $audit_hall->id }}" {{ isset($ie_audit) && $ie_audit->meta_audit_hall_id == $audit_hall->id ? 'selected' : '' }}>{{ $audit_hall->hall_title }}</option>
      @endforeach
    </x-forms.select-option>

    <x-forms.select-option name="meta_audit_type_id" selectClass="form-control-sm" label="Audit Type" divClass="col-12 col-sm-6" required>
        @foreach ($audit_types  as $audit_type)
        <option value="{{ $audit_type->id }}" {{ isset($ie_audit) && $ie_audit->meta_audit_type_id == $audit_type->id ? 'selected' : '' }}>{{ $audit_type->audit_title }}</option>
      @endforeach
    </x-forms.select-option>

    <x-forms.ajax-submit-btn div-class="col-12"  id="submit-button" btn-class="btn-sm btn-primary btn-ladda">Initiate Audit</x-forms.ajax-submit-btn>
</form>