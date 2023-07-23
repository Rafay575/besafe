<div class="row">
  <div class="col-12 mx-auto">
    <div class="multisteps-form mb-5 mx-auto">
      <!--progress bar-->
      <div class="row">
        <div class="col-12 col-lg-8 mx-auto my-4">
          <div class="card">
            <div class="card-body">
              <div class="multisteps-form__progress">
                @isset($near_miss)
                    
                <button class="multisteps-form__progress-btn {{!isset($near_miss) ? 'js-active' : ''}}" type="button" title="Section 1">
                  <span>Section 1</span>
                </button>
                <button class="multisteps-form__progress-btn {{isset($near_miss) ? 'js-active' : ''}}" type="button" title="Section 2">Section 2</button>
                {{-- <button class="multisteps-form__progress-btn" type="button" title="Recommendation">Recommendation</button> --}}
                @else
                <button class="multisteps-form__progress-btn js-active" type="button" title="Create New Near Miss">Create New Near Miss</button>
                @endisset
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--form panels-->
      <div class="row">
        <div class="col-12 col-lg-8 m-auto">
          @if (isset($near_miss))
            <form action="{{route('near-miss.update',$near_miss->id)}}" class="col-12 row mx-auto multisteps-form__form ajax-form" method="post" enctype="multipart/form-data">
             @method('put')
          @else
            <form action="{{route('near-miss.store')}}" class="col-12 row mx-auto multisteps-form__form ajax-form" method="post" enctype="multipart/form-data">
          @endif
              @csrf
            <!--single form panel-->
            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white {{!isset($near_miss) ? 'js-active' : ''}}" data-animation="FadeIn">
              <h5 class="font-weight-bolder mb-0">Section 1 Near Miss</h5>
              {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
              <div class="multisteps-form__content">
                <div class="row">

                  <x-forms.basic-input label="Date" name="date" type="date" value="{{(isset($near_miss) ? Carbon\Carbon::parse($near_miss->date)->format('Y-m-d') : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                   <x-forms.basic-input label="Time" name="time" type="time" value="{{(isset($near_miss) ? Carbon\Carbon::parse($near_miss->time)->format('H:i') : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>

                  <x-forms.select-option name="meta_department_id" selectClass="form-control-sm" label="Department" divClass="col-12 col-sm-6">
                    @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ isset($near_miss) && $near_miss->meta_department_id == $department->id ? 'selected' : '' }}>{{ $department->department_title }}</option>
                    @endforeach
                </x-forms.select-option>

                <x-forms.select-option name="meta_unit_id" selectClass="form-control-sm meta_unit_id" label="Unit" divClass="col-12 col-sm-6">
                  @foreach ($units as $unit)
                  <option value="{{ $unit->id }}" {{ isset($near_miss) && $near_miss->meta_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit_title }}</option>
              @endforeach
              </x-forms.select-option>

              <div class="form-group col-12 col-sm-6">
                <label for="meta_location_id">Location</label>
                <select name="meta_location_id" id="meta_locations" class=" form-control form-control-sm" required>
                  @if (isset($near_miss))
                      @foreach ($near_miss->unit->locations as $location)
                          <option value="{{$location->id}}" {{($near_miss->meta_location_id == $location->id ? 'selected' : '')}}>{{$location->location_title}}</option>
                      @endforeach
                  @endif
                </select>
              </div>

              <x-forms.basic-input label="Other Location" name="other_location" type="text" value="{{(isset($near_miss) ? $near_miss->other_location : '')}}" width="col-6" input-class="form-control-sm form-control"></x-forms.basic-input>
              

              <x-forms.basic-input label="Line" name="line" type="text" value="{{(isset($near_miss) ? $near_miss->line : '')}}" width="col-6" input-class="form-control-sm form-control"></x-forms.basic-input>



            <x-forms.basic-input label="Shift" name="shift" type="text" value="{{(isset($near_miss) ? $near_miss->shift : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" ></x-forms.basic-input>

                
            <x-forms.select-option name="meta_near_miss_class_id" selectClass="form-control-sm" label="Near Miss Classification" divClass="col-12 col-sm-6">
              @foreach ($near_miss_classes as $class)
              <option value="{{ $class->id }}" {{ isset($near_miss) && $near_miss->meta_near_miss_class_id == $class->id ? 'selected' : '' }}>{{ $class->class_title }}</option>
            @endforeach
          </x-forms.select-option>


         


              <x-forms.text-area label="Incident Description" name="description"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                {{isset($near_miss) ? $near_miss->description : ''}}
              </x-forms.text-area>
              {{-- <x-forms.basic-input label="Injured Person" name="injured_person" type="text" placeholder="eg. Ali" value="" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input"></x-forms.basic-input> --}}


                <x-forms.radio-and-check-box-div name="person_involved" label="Person Involved" div-class="col-6">
                    <x-forms.radio-box width="col-2" radio-box-class="person_involved" name="person_involved" checked="{{ isset($near_miss) && $near_miss->person_involved == 1 ? 'true' : 'false' }}" label="Yes" value="1"></x-forms.radio-box>
                    <x-forms.radio-box width="col-2" radio-box-class="person_involved" name="person_involved" checked="{{ isset($near_miss) && $near_miss->person_involved == 0 ? 'true' : 'false' }}" label="No" value="0"></x-forms.radio-box>
              </x-forms.radio-and-check-box-div>



              <x-forms.basic-input label="Witness" name="witness_name" type="text" value="{{(isset($near_miss) ? $near_miss->witness_name : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" ></x-forms.basic-input>



                
                <x-forms.text-area label="Immediate Action" name="immediate_action"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                {{isset($near_miss) ? $near_miss->immediate_action : ''}}
                </x-forms.text-area>

                <x-forms.text-area label="Initial Recommendation" name="initial_recommendation"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                {{isset($near_miss) ? $near_miss->initial_recommendation : ''}}
                </x-forms.text-area>
                
                   


               <x-forms.basic-input label="Initial Attachments" name="initial_attachements[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>

                <div class="row mt-3 table-responsive personTableDiv">

                  <div class="mb-2">
                    <span id="addPersonRecordButton" class="btn btn-sm btn-primary">Add</span>
                  </div>
                  
                  <table class="table table-flush  table-bordered" id="personTable">
                      <thead class="thead-light">
                          <x-table.tblhead heads="employee id,name,department,designation,contact no,health status,X" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" ></x-table.tblhead>
                      </thead>
                      <tbody>
                        @if (isset($near_miss) && !empty($near_miss->persons))
                          @foreach ($near_miss->persons as $person)
                          <tr>
                            <td><input type="hidden" name="persons[{{$loop->iteration}}][sno]" value="{{$loop->iteration}}" />
                            <input type="text" class="form-control form-control-sm" value="{{$person['employee_id']}}" name="persons[{{$loop->iteration}}][employee_id]"></td>
                          <td> <input type="text" class="form-control form-control-sm" value="{{$person['name']}}" name="persons[{{$loop->iteration}}][name]"></td>
                          <td> <input type="text" class="form-control form-control-sm" value="{{$person['department']}}"  name="persons[{{$loop->iteration}}][department]"></td>
                          <td> <input type="text" class="form-control form-control-sm" value="{{$person['designation']}}"  name="persons[{{$loop->iteration}}][designation]"></td>
                          <td> <input type="text" class="form-control form-control-sm" value="{{$person['contact_no']}}"  name="persons[{{$loop->iteration}}][contact_no]"></td>
                          <td> 
                            <select name="persons[{{$loop->iteration}}][health_status]"  class="form-control form-control-sm">
                                <option value="injured" {{$person['health_status'] === 'injured' ? 'selected' : ''}}>Injured</option>
                                <option value="healthy" {{$person['health_status'] === 'healthy' ? 'selected' : ''}}>Healthy</option>
                            </select>
                          </td>
                          <td> <span class="btn btn-sm btn-danger deletePersonRecord">X</span></td>
                        </tr>
                          @endforeach
                        @endif
                      
                      </tbody>
                  </table>
                  
                </div>
              </div>
              
               @isset($near_miss)
               <div class="button-row d-flex mt-4">
                  <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                </div>
                  
               @else 

               <div class="button-row d-flex mt-4">
                @canany(['near_miss.create','near_miss.edit'])
                  <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" id="submit-button" type="submit" title="Send" data-style="expand-left">Send</button>
                  @endcanany
                </div>
                
               @endisset
              </div>
            </div>
            <!--single form panel-->
            
            <!--single form panel-->
            {{-- <div class="card multisteps-form__panel p-3 border-radius-xl bg-white {{isset($near_miss) ? 'js-active' : ''}}" data-animation="FadeIn">
              <h5 class="font-weight-bolder">Section 2 Near Miss</h5>
              <div class="multisteps-form__content">
                <div class="row mt-3">
                  <x-forms.text-area label="Immediate Cuase" name="immediate_cause"  width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2">
                    {{isset($near_miss) ? $near_miss->immediate_cause : ''}}
                  </x-forms.text-area>
                  <x-forms.text-area label="Root Cause" name="root_cause"  width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2">
                    {{isset($near_miss) ? $near_miss->root_cause : ''}}
                  </x-forms.text-area>

                 

                 
                </div>
                <div class="row">
                  <div class="button-row d-flex mt-4 col-12">
                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                  </div>
                </div>
              </div>
            </div> --}}
            <!--single form panel-->

            
            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white {{isset($near_miss) ? 'js-active' : ''}}  " data-animation="FadeIn">
              <div class="row">
                
              <x-forms.select-option name="meta_incident_status_id" selectClass="form-control-sm" label="Status" divClass="col-12 col-sm-6">
                @foreach ($incident_statuses as $status)
                <option value="{{$status->id}}" {{ isset($near_miss) && $near_miss->meta_incident_status_id == $status->id ? 'selected' : '' }}>{{$status->status_title}}</option>
              @endforeach
             </x-forms.select-option>


              <x-forms.basic-input label="Attachments" name="attachements[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>
            </div>


              
              <h5 class="font-weight-bolder">Preventive Actions / Recommendation</h5>
              <div class="multisteps-form__content mt-3">
                <div class="row mt-3 table-responsive">

                  <div class="mb-2">
                    <span id="addRecordButton" class="btn btn-sm btn-primary">Add</span>
                  </div>
                  
                  <table class="table table-flush  table-bordered" id="actionTable">
                      <thead class="thead-light">
                          <x-table.tblhead heads="Action,Responsibility,Target Date,Actual Completion,Remarks,X" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" ></x-table.tblhead>
                      </thead>
                      <tbody>
                        @if (isset($near_miss) && !empty($near_miss->actions))
                          @foreach ($near_miss->actions as $action)
                          <tr>
                            <td><input type="hidden" name="actions[{{$loop->iteration}}][sno]" value="{{$loop->iteration}}" />
                            <input type="text" class="form-control form-control-sm" value="{{$action['action']}}" name="actions[{{$loop->iteration}}][action]"></td>
                           <td> <input type="text" class="form-control form-control-sm" value="{{$action['responsible']}}" name="actions[{{$loop->iteration}}][responsible]"></td>
                           <td> <input type="date" class="form-control form-control-sm" value="{{$action['target_date']}}"  name="actions[{{$loop->iteration}}][target_date]"></td>
                           <td> <input type="date" class="form-control form-control-sm" value="{{$action['actual_completion']}}"  name="actions[{{$loop->iteration}}][actual_completion]"></td>
                           <td> <input type="text" class="form-control form-control-sm" value="{{$action['remarks']}}"  name="actions[{{$loop->iteration}}][remarks]"></td>
                           <td> <span class="btn btn-sm btn-danger deleteActionRecord">X</span></td>
                         </tr>
                          @endforeach
                        @endif
                       
                      </tbody>
                  </table>
                  
                </div>
                <div class="button-row d-flex mt-4">
                  <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                  <input type="hidden" name="redirect" value="{{url()->previous()}}">
                  @canany(['near_miss.create','near_miss.edit'])
                  <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" id="submit-button" type="submit" title="Send" data-style="expand-left">Send</button>
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

