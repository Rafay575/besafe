<div class="row ">
    <div class="col-12 ">
      <div class="multisteps-form">
        <!--progress bar-->
        <div class="row">
          <div class="col-12 col-lg-8 mx-auto my-4">
            <div class="card">
              <div class="card-body">
                <div class="multisteps-form__progress">
                  <button class="multisteps-form__progress-btn js-active" type="button" title="Stage 1">
                    <span>Stage 1</span>
                  </button>
                  <button class="multisteps-form__progress-btn" type="button" title="Stage 2">Stage 2</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--form panels-->
        <div class="row">
          <div class="col-12 col-lg-8 m-auto">
            @if (isset($injury))
            <form action="{{route('injuries.update',$injury->id)}}" class="col-12 row mx-auto multisteps-form__form ajax-form" method="post" enctype="multipart/form-data">
             @method('put')
          @else
            <form action="{{route('injuries.store')}}" class="col-12 row mx-auto multisteps-form__form ajax-form" method="post" enctype="multipart/form-data">
          @endif
              @csrf
              <!--single form panel-->
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                <h5 class="font-weight-bolder mb-0">Stage 1</h5>
                {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
                <div class="multisteps-form__content">
                  
                  <div class="row mt-3">
                    <x-forms.select-option name="meta_incident_category_id" selectClass="form-control-sm multisteps-form__input" label="Incident Category" divClass="col-12 col-sm-6">
                      @foreach ($incident_categories as $incident_category)
                      <option value="{{$incident_category->id}}" {{ isset($injury) && $injury->meta_incident_category_id == $incident_category->id ? 'selected' : '' }}>{{$incident_category->incident_category_title}}</option>
                     @endforeach
                    </x-forms.select-option>
                    <x-forms.select-option name="meta_injury_category_id" selectClass="form-control-sm multisteps-form__input" label="Injury Category" divClass="col-12 col-sm-6">
                      @foreach ($injury_categories as $injury_category)
                      <option value="{{$injury_category->id}}" {{ isset($injury) && $injury->meta_injury_category_id == $injury_category->id ? 'selected' : '' }}>{{$injury_category->injury_category_title}}</option>
                     @endforeach
                    </x-forms.select-option>
                  </div>

                  <div class="row mt-3">
                    
                   <x-forms.basic-input label="Date" name="date" type="date" placeholder="" value="{{(isset($injury) ? Carbon\Carbon::parse($injury->date)->format('Y-m-d') : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                    <x-forms.select-option name="meta_incident_status_id" selectClass="form-control-sm" label="Status" divClass="col-12 col-sm-6">
                        @foreach ($incident_statuses as $status)
                        <option value="{{$status->id}}" {{ isset($injury) && $injury->meta_incident_status_id == $status->id ? 'selected' : '' }}>{{$status->status_title}}</option>
                      @endforeach
                    </x-forms.select-option>

                  </div>

                  <div class="row mt-3">

                    <x-forms.radio-and-check-box-div name="employee_involved" label="Employee Involved" div-class="col-4">
                        <x-forms.radio-box width="col-2" radio-box-class="" name="employee_involved" checked="{{ isset($injury) && $injury->employee_involved == 'yes' ? 'true' : 'false' }}" label="Yes" value="yes"></x-forms.radio-box>
                        <x-forms.radio-box width="col-2" radio-box-class="" name="employee_involved" checked="{{ isset($injury) && $injury->employee_involved == 'no' ? 'true' : 'false' }}" label="No" value="no"></x-forms.radio-box>
                  </x-forms.radio-and-check-box-div>
                    
                
                  

                    <x-forms.select-option name="meta_sgfl_relation_id" selectClass="form-control-sm multisteps-form__input" label="Relationship to SGFL" divClass="col-12 col-sm-4">
                      @foreach ($sgfl_relations as $sgfl_relation)
                      <option value="{{$sgfl_relation->id}}" {{ isset($injury) && $injury->meta_sgfl_relation_id == $sgfl_relation->id ? 'selected' : '' }}>{{$sgfl_relation->sgfl_relation_title}}</option>
                     @endforeach
                  </x-forms.select-option>

                  <x-forms.basic-input label="Witness Name" name="witness_name" type="text" placeholder="Witness name"  value="{{(isset($injury) ? $injury->witness_name : '')}}" width="col-12 col-sm-4" input-class="multisteps-form__input" ></x-forms.basic-input>

                    
                 </div>
                 <div class="row mt-3">
                    <x-forms.text-area label="Details" name="details"  width="col-12" text-area-class="" cols="" rows="3">{{(isset($injury) ? $injury->details : '')}}</x-forms.text-area>
                 </div>
                
                 <div class="row mt-3 mb-6 ">
                  <x-forms.basic-input label="Attachments" name="attachements[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>
                  <x-forms.basic-input label="Immediate Action" name="immediate_action" type="text" placeholder=""  value="{{(isset($injury) ? $injury->immediate_action : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" ></x-forms.basic-input>
                </div>

                 <div class="button-row d-flex mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                  </div>

                 
                  
                </div>
              </div>
              <!--single form panel-->
            
              <!--single form panel-->
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                <h5 class="font-weight-bolder">Stage 2</h5>
                <div class="multisteps-form__content mt-3">
                  <div class="row mt-3">
                    <x-forms.text-area label="Key Findings" name="key_finding"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">{{(isset($injury) ? $injury->key_finding : '')}}</x-forms.text-area>
                    <x-forms.basic-input label="Interview Attachments" name="interview_attachs[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>
                    {{-- <x-forms.text-area label="Preventative Measure" name="preventative_measure"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.text-area> --}}
                  </div>

                  <div class="row mt-3">
                    <x-forms.select-option name="meta_immediate_causes[]" multiple selectClass="form-control-sm multisteps-form__input" label="Immediate Causes" divClass="col-12 col-sm-6">
                        @foreach ($immediate_causes as $cause)
                        <option value="{{ $cause->id }}" {{ isset($injury) && in_array($cause->id,$injury->immediate_causes->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $cause->cause_title }}</option>
                        @endforeach
                    </x-forms.select-option>

                    {{-- <x-forms.select-option name="substandard_condition" selectClass="form-control-sm multisteps-form__input" label="Substandard Conditions" divClass="col-12 col-sm-6">
                        <option value="Value">Conditon 1</option>
                        <option value="Value">Condition 2</option>
                    </x-forms.select-option> --}}
                  </div>

                  <div class="row mt-3">
                    <x-forms.select-option name="meta_basic_causes[]" multiple selectClass="form-control-sm multisteps-form__input" label="Basic Clause" divClass="col-12 col-sm-6">
                      @foreach ($basic_causes as $cause)
                      <option value="{{ $cause->id }}" {{ isset($injury) && in_array($cause->id,$injury->basic_causes->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $cause->cause_title }}</option>
                      @endforeach
                    </x-forms.select-option>
                    
                    <x-forms.select-option name="meta_root_causes[]" multiple selectClass="form-control-sm multisteps-form__input" label="Root Cause" divClass="col-12 col-sm-6">
                      @foreach ($root_causes as $cause)
                      <option value="{{ $cause->id }}" {{ isset($injury) && in_array($cause->id,$injury->root_causes->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $cause->cause_title }}</option>
                      @endforeach
                    </x-forms.select-option>

                    <x-forms.select-option name="meta_contact_types[]" multiple selectClass="form-control-sm multisteps-form__input" label="Type of Contact" divClass="col-12 col-sm-6">
                      @foreach ($contacts as $contact)
                      <option value="{{ $contact->id }}" {{ isset($injury) && in_array($contact->id,$injury->contacts->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $contact->type_title }}</option>
                      @endforeach
                    </x-forms.select-option>
                  </div>

                  </div>
           
                  <div class="row mt-3">
                    <div class="mb-2">
                      <span id="addRecordButton" class="btn btn-sm btn-primary">Add</span>
                    </div>

                    <table class="table table-flush  table-bordered"  id="actionTable">
                      <thead class="thead-light">
                          <x-table.tblhead heads="Action,Description,Timeline,Status,X" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" ></x-table.tblhead>
                      </thead>
                      <tbody>

                        @if (isset($injury) && !empty($injury->actions))
                        @foreach ($injury->actions as $action)
                        <tr>
                          <td>
                            <input type="hidden" name="actions[{{$loop->iteration}}][sno]" value="{{$loop->iteration}}" />
                            <input type="text" class="form-control form-control-sm"     value="{{$action['action']}}" name="actions[{{$loop->iteration}}][action]"></td>
                            <td> <input type="text" class="form-control form-control-sm" value="{{$action['description']}}"  name="actions[{{$loop->iteration}}][description]"></td>
                            <td> <input type="text" class="form-control form-control-sm" value="{{$action['timeline']}}" name="actions[{{$loop->iteration}}][timeline]"></td>
                          <td> 
                            <select name="actions[{{$loop->iteration}}][status]"  class="form-control form-control-sm">
                                <option value="pending" {{$action['status'] === 'pending' ? 'selected' : ''}}>Pending</option>
                                <option value="completed" {{$action['status'] === 'completed' ? 'selected' : ''}}>Completed</option>
                                <option value="in progress" {{$action['status'] === 'in progress' ? 'selected' : ''}}>In Progress</option>
                                <option value="active" {{$action['status'] === 'active' ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{$action['status'] === 'inactive' ? 'selected' : ''}}>In Active</option>
                                {{-- <option value="active" {{($action['status'] === 'active') ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{($action['status'] != 'active') ? 'selected' : ''}}>InActive</option> --}}
                             </select>
                          </td>
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
                    @canany(['injury.edit','injury.create'])
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
