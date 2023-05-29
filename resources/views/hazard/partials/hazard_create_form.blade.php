@if (isset($hazard))
<form action="{{route('hazards.update',$hazard->id)}}" class="col-12 row dropzone ajax-form" method="post" id="dropzone" enctype="multipart/form-data">
@method('put')
 @else
<form action="{{route('hazards.store')}}" class="col-12 row dropzone ajax-form" method="post" id="dropzone" enctype="multipart/form-data">
@endif
    @csrf

    <x-forms.select-option name="meta_unit_id" selectClass="form-control-sm" label="Unit" divClass="col-12 col-sm-6">
        @foreach ($units as $unit)
        <option value="{{ $unit->id }}" {{ isset($hazard) && $hazard->meta_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit_title }}</option>
    @endforeach
    </x-forms.select-option>


    <x-forms.basic-input label="Date" name="date" type="date" value="{{(isset($hazard) ? Carbon\Carbon::parse($hazard->date)->format('Y-m-d') : '')}}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
    
    
    <x-forms.basic-input label="Location" name="location" type="text" value="{{ isset($hazard) ? $hazard->location : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
   
   
    <x-forms.radio-and-check-box-div name="meta_risk_level_id" label="Risk Level" div-class="col-6">
        @foreach ($risk_levels as $risk_level)
            <x-forms.radio-box width="col-2" radio-box-class="" name="meta_risk_level_id" checked="{{ isset($hazard) && $hazard->meta_risk_level_id == $risk_level->id ? 'true' : 'false' }}" label="{{$risk_level->risk_level_title}}" value="{{$risk_level->id}}"></x-forms.radio-box>
        @endforeach
    </x-forms.radio-and-check-box-div>


    <x-forms.select-option name="meta_department_id" selectClass="form-control-sm" label="Department" divClass="col-12 col-sm-6">
        @foreach ($departments as $department)
         <option value="{{ $department->id }}" {{ isset($hazard) && $hazard->meta_department_id == $department->id ? 'selected' : '' }}>{{ $department->department_title }}</option>
         @endforeach
    </x-forms.select-option>

    <x-forms.select-option name="meta_line_id" selectClass="form-control-sm" label="Line" divClass="col-12 col-sm-6">
        @foreach ($lines as $line)
        <option value="{{ $line->id }}" {{ isset($hazard) && $hazard->meta_line_id == $line->id ? 'selected' : '' }}>{{ $line->line_title }}</option>
      @endforeach
    </x-forms.select-option>

    <x-forms.text-area label="Description" name="description"  width="col-6" text-area-class="" cols="" rows="3">
        {{isset($hazard) ? $hazard->description : ''}}
     </x-forms.text-area>


    {{-- <x-forms.text-area label="Solution" name="solution"  width="col-6" text-area-class="" cols="" rows="3">
        {{isset($hazard) ? $hazard->solution : ''}}
     </x-forms.text-area> --}}

      <x-forms.select-option name="meta_department_tag_id" selectClass="form-control-sm" label="Department Tag Assign" divClass="col-12 col-sm-6">
        @foreach ($department_tags as $tag)
        <option value="{{ $tag->id }}" {{ isset($hazard) && $hazard->meta_department_tag_id == $tag->id ? 'selected' : '' }}>{{ $tag->department_tag_title }}</option>
       @endforeach
    </x-forms.select-option>

    <x-forms.basic-input label="Cost of Action" name="action_cost" type="number" value="{{ isset($hazard) ? $hazard->action_cost : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>

    <x-forms.select-option name="meta_incident_status_id" selectClass="form-control-sm" label="Status" divClass="col-12 col-sm-6">
        @foreach ($incident_statuses as $status)
         <option value="{{$status->id}}" {{ isset($hazard) && $hazard->meta_incident_status_id == $status->id ? 'selected' : '' }}>{{$status->status_title}}</option>
       @endforeach
    </x-forms.select-option>

    
     <input type="hidden" name="redirect" value="{{url()->previous()}}">
    <x-forms.ajax-submit-btn div-class="col-12"  id="submit-button" btn-class="btn-sm btn-primary btn-ladda">Submit</x-forms.ajax-submit-btn>
</form>