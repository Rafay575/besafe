@if (isset($ptw))
<form action="{{route('ptws.update',$ptw->id)}}" class="col-12 row  ajax-form" method="post"  enctype="multipart/form-data">
@method('put')
 @else
<form action="{{route('ptws.store')}}" class="col-12 row  ajax-form" method="post"  enctype="multipart/form-data">
@endif
    @csrf

  


    <x-forms.basic-input label="Date" name="date" type="date" value="{{(isset($ptw) ? Carbon\Carbon::parse($ptw->date)->format('Y-m-d') : '')}}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
    <x-forms.basic-input label="Start Time" name="start_time" type="time" value="{{(isset($ptw) ? Carbon\Carbon::parse($ptw->start_time)->format('H:i') : '')}}" width="col-3" input-class="form-control-sm"></x-forms.basic-input>
    <x-forms.basic-input label="End Time" name="end_time" type="time" value="{{(isset($ptw) ? Carbon\Carbon::parse($ptw->end_time)->format('H:i') : '')}}" width="col-3" input-class="form-control-sm"></x-forms.basic-input>
    {{-- <x-forms.basic-input label="Location" name="location" type="text" value="{{ isset($ptw) ? $ptw->location : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input> --}}
    <x-forms.basic-input label="Work Area" name="work_area" type="text" value="{{ isset($ptw) ? $ptw->work_area : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
    <x-forms.basic-input label="Line Machine" name="line_machine" type="text" value="{{ isset($ptw) ? $ptw->line_machine : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
   
    <x-forms.radio-and-check-box-div name="is_ptw_exist" label="Is PTW Exist" div-class="col-4">
        <x-forms.radio-box width="col-2" radio-box-class="" name="is_ptw_exist" checked="{{ isset($ptw) && $ptw->is_ptw_exist ? 'true' : 'false' }}" label="Yes" value="1"></x-forms.radio-box>
        <x-forms.radio-box width="col-2" radio-box-class="" name="is_ptw_exist" checked="{{ isset($ptw) && $ptw->is_ptw_exist ? 'false' : 'true' }}" label="No" value="0"></x-forms.radio-box>
  </x-forms.radio-and-check-box-div>
  
  <x-forms.basic-input label="Cross Reference" name="cross_reference" type="text" value="{{ isset($ptw) ? $ptw->cross_reference : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
  
  <x-forms.radio-and-check-box-div name="moc_required" label="MOC Required" div-class="col-4">
        <x-forms.radio-box width="col-2" radio-box-class="" name="moc_required" checked="{{ isset($ptw) && $ptw->moc_required ? 'true' : 'false' }}" label="Yes" value="1"></x-forms.radio-box>
        <x-forms.radio-box width="col-2" radio-box-class="" name="moc_required" checked="{{ isset($ptw) && $ptw->moc_required ? 'false' : 'true' }}" label="No" value="0"></x-forms.radio-box>
  </x-forms.radio-and-check-box-div>

  <x-forms.basic-input label="MOC Title" name="moc_title" type="text" value="{{ isset($ptw) ? $ptw->moc_title : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
  <x-forms.basic-input label="MOC Description" name="moc_desc" type="text" value="{{ isset($ptw) ? $ptw->moc_desc : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
  <x-forms.basic-input label="Working Group" name="working_group" type="text" value="{{ isset($ptw) ? $ptw->working_group : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
  <x-forms.basic-input label="Worker Name" name="worker_name" type="text" value="{{ isset($ptw) ? $ptw->worker_name : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>

    


    


    <x-forms.select-option name="meta_ptw_type_id[]" multiple selectClass="form-control-sm multisteps-form__input" label="PTW Types" divClass="col-12 col-sm-6">
        @foreach ($ptw_types as $ptw_type)
        <option value="{{ $ptw_type->id }}" {{ isset($ptw) && in_array($ptw_type->id,$ptw->ptw_types->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $ptw_type->ptw_type_title }}</option>
        @endforeach
      </x-forms.select-option>
    {{-- <x-forms.select-option name="meta_ptw_item_id[]" multiple selectClass="form-control-sm multisteps-form__input" label="PTW Items" divClass="col-12 col-sm-6">
        @foreach ($ptw_items as $ptw_item)
        <option value="{{ $ptw_item->id }}" {{ isset($ptw) && in_array($ptw_item->id,$ptw->ptw_items->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $ptw_item->ptw_item_title }}</option>
        @endforeach
      </x-forms.select-option> --}}


    <x-forms.text-area label="Work Description" name="work_desc"  width="col-6" text-area-class="" cols="" rows="3">
        {{isset($ptw) ? $ptw->work_desc : ''}}
     </x-forms.text-area>


    
     <input type="hidden" name="redirect" value="{{url()->previous()}}">
     @canany(['ptw.create','ptw.edit'])
     <x-forms.ajax-submit-btn div-class="col-12"  id="submit-button" btn-class="btn-sm btn-primary btn-ladda">Submit</x-forms.ajax-submit-btn>
         
     @endcanany
</form>