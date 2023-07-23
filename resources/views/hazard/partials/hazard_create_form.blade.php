<div class="row ">
  <div class="col-12 ">
    <div class="multisteps-form">
      <!--progress bar-->
      <div class="row">
        <div class="col-12 col-lg-8 mx-auto my-4">
          <div class="card">
            <div class="card-body">
              <div class="multisteps-form__progress">
                @isset($hazard)
                <button class="multisteps-form__progress-btn {{!isset($hazard) ? 'js-active' : ''}}" type="button" title="Stage 1">
                  <span>Stage 1</span>
                </button>
                  <button class="multisteps-form__progress-btn {{isset($hazard) ? 'js-active' : ''}}" type="button" title="Stage 2">Stage 2</button>
              @else
               <button class="multisteps-form__progress-btn js-active" type="button" title="Create New Hazard">Create New Hazard</button>
              @endisset
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--form panels-->
      <div class="row">
        <div class="col-12 col-lg-8 m-auto">
          @if (isset($hazard))
          <form action="{{route('hazards.update',$hazard->id)}}" class="col-12 row mx-auto multisteps-form__form ajax-form" method="post" enctype="multipart/form-data">
           @method('put')
        @else
          <form action="{{route('hazards.store')}}" class="col-12 row mx-auto multisteps-form__form ajax-form" method="post" enctype="multipart/form-data">
        @endif
            @csrf
            <!--single form panel-->
            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white {{!isset($hazard) ? 'js-active' : ''}}" data-animation="FadeIn">
              <h5 class="font-weight-bolder mb-0">Stage 1</h5>
              {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
              <div class="multisteps-form__content">
                
                <div class="row">


                    <x-forms.basic-input label="Date" name="date" type="date" value="{{(isset($hazard) ? Carbon\Carbon::parse($hazard->date)->format('Y-m-d') : '')}}" width="col-6" input-class="form-control-sm form-control"></x-forms.basic-input>

                    <x-forms.select-option name="meta_department_id" selectClass="form-control-sm" label="Department" divClass="col-12 col-sm-6">
                      @foreach ($departments as $department)
                      <option value="{{ $department->id }}" {{ isset($hazard) && $hazard->meta_department_id == $department->id ? 'selected' : '' }}>{{ $department->department_title }}</option>
                      @endforeach
                  </x-forms.select-option>


                    <x-forms.select-option name="meta_unit_id" selectClass="form-control-sm meta_unit_id" label="Unit" divClass="col-12 col-sm-6">
                        @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ isset($hazard) && $hazard->meta_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit_title }}</option>
                    @endforeach
                    </x-forms.select-option>


                  
                  <div class="form-group col-12 col-sm-6">
                    <label for="meta_location_id">Location</label>
                    <select name="meta_location_id" id="meta_locations" class=" form-control form-control-sm" required>
                      @if (isset($hazard))
                          @foreach ($hazard->unit->locations as $location)
                              <option value="{{$location->id}}" {{($hazard->meta_location_id == $location->id ? 'selected' : '')}}>{{$location->location_title}}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>

                  <x-forms.basic-input label="Other Location" name="other_location" type="text" value="{{(isset($hazard) ? $hazard->other_location : '')}}" width="col-6" input-class="form-control-sm form-control"></x-forms.basic-input>

                  
                  <x-forms.basic-input label="Line" name="line" type="text" value="{{(isset($hazard) ? $hazard->line : '')}}" width="col-6" input-class="form-control-sm form-control"></x-forms.basic-input>



                {{-- <x-forms.text-area label="Others" name="others"  width="col-6" text-area-class="" cols="" rows="3">
                  {{isset($hazard) ? $hazard->others : ''}}
                </x-forms.text-area> --}}


                  
                    <x-forms.radio-and-check-box-div name="meta_risk_level_id" label="Risk Level" div-class="col-6">
                        @foreach ($risk_levels as $risk_level)
                            <x-forms.radio-box width="col-2" radio-box-class="" name="meta_risk_level_id" checked="{{ isset($hazard) && $hazard->meta_risk_level_id == $risk_level->id ? 'true' : 'false' }}" label="{{$risk_level->risk_level_title}}" value="{{$risk_level->id}}"></x-forms.radio-box>
                        @endforeach
                    </x-forms.radio-and-check-box-div>


                  

                  
                    <x-forms.text-area label="Description" name="description"  width="col-6" text-area-class="" cols="" rows="3">
                        {{isset($hazard) ? $hazard->description : ''}}
                    </x-forms.text-area>


                  

                      <x-forms.select-option name="meta_department_tag_id" selectClass="form-control-sm" label="Department Tag Assign" divClass="col-12 col-sm-6">
                        @foreach ($department_tags as $tag)
                        <option value="{{ $tag->id }}" {{ isset($hazard) && $hazard->meta_department_tag_id == $tag->id ? 'selected' : '' }}>{{ $tag->department_tag_title }}</option>
                      @endforeach
                    </x-forms.select-option>


                 <x-forms.basic-input label="Initial Attachments" name="initial_attachements[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>


                </div>

        
                @isset($hazard)
                    
                <div class="button-row d-flex mt-4">
                   <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                 </div>
                @else
                @canany(['hazard.edit','hazard.create'])
                <div class="button-row d-flex mt-4">
                  <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" type="submit" title="Send" data-style="expand-left">Send</button>
                </div>
              @endcanany
                @endisset

               
                
              </div>
            </div>
            <!--single form panel-->
          
            <!--single form panel-->
            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white {{isset($hazard) ? 'js-active' : ''}}" data-animation="FadeIn">
              <h5 class="font-weight-bolder">Stage 2</h5>
              <div class="multisteps-form__content mt-3">
                
                <div class="row mt-3">

                  <x-forms.basic-input label="Cost of Action" name="action_cost" type="number" value="{{ isset($hazard) ? $hazard->action_cost : '' }}" width="col-6" input-class="form-control-sm"></x-forms.basic-input>


                  <x-forms.text-area label="Action" name="action"  width="col-6" text-area-class="" cols="" rows="3">
                    {{isset($hazard) ? $hazard->action : ''}}
                  </x-forms.text-area>



                  <x-forms.select-option name="meta_incident_status_id" selectClass="form-control-sm" label="Status" divClass="col-12 col-sm-6">
                    @foreach ($incident_statuses as $status)
                    <option value="{{$status->id}}" {{ isset($hazard) && $hazard->meta_incident_status_id == $status->id ? 'selected' : '' }}>{{$status->status_title}}</option>
                  @endforeach
                 </x-forms.select-option>

                 <x-forms.basic-input label="Attachments" name="attachements[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>




                </div>
                

              

                </div>
         
                
                <div class="button-row d-flex mt-4">
                  <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                  <input type="hidden" name="redirect" value="{{url()->previous()}}">
                  @canany(['hazard.edit','hazard.create'])
                    <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" type="submit" title="Send" data-style="expand-left">Send</button>
                  @endcanany
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> 
</div>
