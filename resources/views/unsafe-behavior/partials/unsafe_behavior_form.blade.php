@if (isset($unsafe_behavior))
<form action="{{route('unsafe-behaviors.update',$unsafe_behavior->id)}}" class="col-12 row dropzone ajax-form" method="post" id="dropzone" enctype="multipart/form-data">
@method('put')
 @else
<form action="{{route('unsafe-behaviors.store')}}" class="col-12 row dropzone ajax-form" method="post" id="dropzone" enctype="multipart/form-data">
@endif
@csrf
    <x-forms.select-option name="meta_unit_id" selectClass="form-control-sm" label="Unit" divClass="col-12 col-sm-6">
        @foreach ($units as $unit)
        <option value="{{ $unit->id }}" {{ isset($unsafe_behavior) && $unsafe_behavior->meta_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit_title }}</option>
      @endforeach
    </x-forms.select-option>
    <x-forms.select-option name="meta_department_id" selectClass="form-control-sm" label="Department" divClass="col-12 col-sm-6">
        @foreach ($departments as $department)
         <option value="{{ $department->id }}" {{ isset($unsafe_behavior) && $unsafe_behavior->meta_department_id == $department->id ? 'selected' : '' }}>{{ $department->department_title }}</option>
         @endforeach
    </x-forms.select-option>
    <x-forms.select-option name="meta_line_id" selectClass="form-control-sm" label="Line" divClass="col-12 col-sm-6">
        @foreach ($lines as $line)
        <option value="{{ $line->id }}" {{ isset($unsafe_behavior) && $unsafe_behavior->meta_line_id == $line->id ? 'selected' : '' }}>{{ $line->line_title }}</option>
      @endforeach
    </x-forms.select-option>
    <x-forms.basic-input label="Date" name="date" type="date" value="{{(isset($unsafe_behavior) ? Carbon\Carbon::parse($unsafe_behavior->date)->format('Y-m-d') : '')}}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>
   
    <x-forms.select-option name="unsafe_behavior_types[]" multiple selectClass="form-control-sm" label="Type of Unsafe Behavior" divClass="col-12 col-sm-6">
        {{-- @foreach ($ub_types as $ub_type)
        <option value="{{$ub_type->id}}">{{$ub_type->unsafe_behavior_type_title}}</option>
       @endforeach --}}
       @foreach ($ub_types as $ub_type)
       <option value="{{ $ub_type->id }}" {{ isset($unsafe_behavior) && in_array($ub_type->id,$unsafe_behavior->unsafe_behavior_types->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $ub_type->unsafe_behavior_type_title }}</option>
     @endforeach
    </x-forms.select-option>

    <x-forms.select-option name="meta_incident_status_id" selectClass="form-control-sm" label="Status" divClass="col-12 col-sm-6">
        @foreach ($incident_statuses as $status)
         <option value="{{$status->id}}" {{ isset($unsafe_behavior) && $unsafe_behavior->meta_incident_status_id == $status->id ? 'selected' : '' }}>{{$status->status_title}}</option>
       @endforeach
    </x-forms.select-option>

    
    <x-forms.text-area label="Details of Unsafe Behavior" name="details"  width="col-12" text-area-class="" cols="" rows="3">
    {{isset($unsafe_behavior) ? $unsafe_behavior->details : ''}}
    </x-forms.text-area>

      <div class="form-group col-12 mt-2">
        <input type="hidden" name="redirect" value="{{url()->previous()}}">
        <button class="btn btn-primary ms-auto mb-0 btn-ladda" type="submit" id="submit-button" title="Submit" data-style="expand-left">Submit</button>
      </div>
</form>