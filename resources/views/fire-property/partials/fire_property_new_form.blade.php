<div class="row">
    <div class="col-12">
      <div class="multisteps-form mb-5">
        <!--progress bar-->
        <div class="row">
          <div class="col-12 col-lg-8 mx-auto my-4">
            <div class="card">
              <div class="card-body">
                <div class="multisteps-form__progress">
                  <button class="multisteps-form__progress-btn js-active" type="button" title="Section 1">
                    <span>Section 1</span>
                  </button>
                  <button class="multisteps-form__progress-btn" type="button" title="Section 2">Section 2</button>
                  <button class="multisteps-form__progress-btn" type="button" title="Section 3">Section 3</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--form panels-->
        <div class="row">
          <div class="col-12 col-lg-8 m-auto">
            @if (isset($fire_property))
            <form action="{{route('fire-property.update',$fire_property->id)}}" class="col-12 row mx-auto multisteps-form__form ajax-form" method="post" enctype="multipart/form-data">
             @method('put')
          @else
            <form action="{{route('fire-property.store')}}" class="col-12 row mx-auto multisteps-form__form ajax-form" method="post" enctype="multipart/form-data">
          @endif
              @csrf
              <!--single form panel-->
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                <h5 class="font-weight-bolder mb-0">Section 1 Fire / Property damage</h5>
                {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
                <div class="multisteps-form__content">
                  <div class="row mt-3">
                   <x-forms.basic-input label="Date" name="date" type="date" placeholder="" value="{{(isset($fire_property) ? Carbon\Carbon::parse($fire_property->date)->format('Y-m-d') : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                   <x-forms.basic-input label="Reference" name="reference" type="text" placeholder="" value="{{ isset($fire_property) ? $fire_property->reference : '' }}" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input" required></x-forms.basic-input>
                  </div>
                  <div class="row mt-3">


                    <x-forms.select-option name="meta_unit_id" selectClass="form-control-sm" divClass="col-6" label="Unit" required>
                      @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ isset($fire_property) && $fire_property->meta_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit_title }}</option>
                      @endforeach
                    </x-forms.select-option>


                   <x-forms.basic-input label="Location" name="location" type="text" placeholder="type location"  value="{{ isset($fire_property) ? $fire_property->location : '' }}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
               
               
                  </div>
                  <div class="row mt-3" >
                 
                  <x-forms.select-option name="meta_fire_category_id" selectClass="form-control-sm fire_categories" divClass="col-6" label="Fire Category" >
                      @foreach ($fire_categories as $fire_category)
                        <option value="{{$fire_category->id}}" {{ isset($fire_property) && $fire_property->meta_fire_category_id == $fire_category->id ? 'selected' : '' }}>{{$fire_category->fire_category_title}}</option>
                      @endforeach
                  </x-forms.select-option>


                  <x-forms.select-option name="meta_property_damage_id" selectClass="form-control-sm property_damages"  divClass="col-6" label="Property Damages" >
                      @foreach ($property_damages as $property_damage)
                        <option value="{{$property_damage->id}}" {{ isset($fire_property) && $fire_property->meta_property_damage_id == $property_damage->id ? 'selected' : '' }}>{{$property_damage->property_damage_title}}</option>
                      @endforeach
                  </x-forms.select-option>
                 
                 </div>

                 <div class="row mt-3">
                    <x-forms.text-area label="Description" name="description"  width="col-6" text-area-class="" cols="" rows="3">
                      {{isset($fire_property) ? $fire_property->description : ''}}
                    </x-forms.text-area>
                    <x-forms.text-area label="Immediate Action" name="immediate_action"  width="col-6" text-area-class="" cols="" rows="3">
                      {{isset($fire_property) ? $fire_property->immediate_action : ''}}
                    </x-forms.text-area>
                 </div>

                 <div class="row mt-3">
                  <x-forms.basic-input label="Attachments" name="attachements[]" type="file" multiple  width="col-12 col-sm-12" value="" input-class="multisteps-form__input"></x-forms.basic-input>
                </div>

                 <div class="button-row d-flex mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                  </div>

                  
                  
                </div>
              </div>
              <!--single form panel-->
              
              <!--single form panel-->
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                <h5 class="font-weight-bolder">Section 2 Fire / Property damage</h5>
                <div class="multisteps-form__content">
                  <div class="row mt-3">

                   
                    <x-forms.text-area label="Immediate Cause" name="immediate_cause"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                      {{isset($fire_property) ? $fire_property->immediate_cause : ''}}
                     </x-forms.text-area>
                     
                    <x-forms.text-area label="Root Cause" name="root_cause"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                      {{isset($fire_property) ? $fire_property->root_cause : ''}}
                     </x-forms.text-area>
                
                  </div>
                  <div class="row mt-3">
                    <x-forms.text-area label="Has similar incident happend before?" name="similar_incident_before"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                      {{isset($fire_property) ? $fire_property->similar_incident_before : ''}}
                     </x-forms.text-area>

                     <x-forms.select-option name="meta_incident_status_id" selectClass="form-control-sm" label="Status" divClass="col-12 col-sm-6">
                        @foreach ($incident_statuses as $status)
                        <option value="{{$status->id}}" {{ isset($fire_property) && $fire_property->meta_incident_status_id == $status->id ? 'selected' : '' }}>{{$status->status_title}}</option>
                      @endforeach
                    </x-forms.select-option>

                  </div>
                  <div class="row mt-3">

                    <table class="table table-flush  table-bordered">
                      <thead class="thead-light">
                          <x-table.tblhead heads="Title,Description,Value of Loss" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" ></x-table.tblhead>
                      </thead>
                      <tbody>
                        <tr>
                          <td><i class="badge badge-dark">Direct Loss</i></td>
                          <td>
                           <x-forms.basic-input label="" name="loss_calculation[direct_loss][description]" type="text" placeholder="description"  value="{{(isset($fire_property)) ? $fire_property->loss_calculation['direct_loss']['description'] : ''}}" width="col-12" input-class="multisteps-form__input" ></x-forms.basic-input>
                          </td>
                          <td>
                           <x-forms.basic-input label="" name="loss_calculation[direct_loss][value]" type="number" placeholder="00"  value="{{(isset($fire_property)) ? $fire_property->loss_calculation['direct_loss']['value'] : ''}}" width="col-12 " input-class="multisteps-form__input direct_loss" ></x-forms.basic-input>
                          </td>
                        </tr>
                        <tr>
                          <td><i class="badge badge-dark">InDirect Loss</i></td>
                          <td>
                           <x-forms.basic-input label="" name="loss_calculation[indirect_loss][description]" type="text" placeholder="description"  value="{{(isset($fire_property)) ? $fire_property->loss_calculation['indirect_loss']['description'] : ''}}" width="col-12" input-class="multisteps-form__input" ></x-forms.basic-input>
                          </td>
                          <td>
                           <x-forms.basic-input label="" name="loss_calculation[indirect_loss][value]" value="{{(isset($fire_property)) ? $fire_property->loss_calculation['indirect_loss']['value'] : ''}}" type="number" placeholder="00"   width="col-12 " input-class="multisteps-form__input indirect_loss" ></x-forms.basic-input>
                          </td>
                        </tr>

                        <tr>
                          <td><i class="badge badge-dark">Total Loss</i></td>
                          <td>
                           <x-forms.basic-input label="" readonly name="loss_calculation[total_loss]" value="{{(isset($fire_property)) ? $fire_property->loss_calculation['total_loss'] : ''}}" type="number" placeholder="00"   width="col-12 " input-class="multisteps-form__input total_loss" ></x-forms.basic-input>
                          </td>
                        </tr>
                      </tbody>
                    </table>


                  </div>
                  <div class="row">
                    <div class="button-row d-flex mt-4 col-12">
                      <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                      <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                    </div>
                  </div>
                </div>
              </div>
              <!--single form panel-->
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                <h5 class="font-weight-bolder">Preventive Actions / Recommendation</h5>
                <div class="multisteps-form__content mt-3">
                  <div class="row mt-3 table-responsive">

                    <x-forms.text-area label="Loss Recovery Method" name="loss_recovery_method"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                      {{isset($fire_property) ? $fire_property->loss_recovery_method : ''}}
                    </x-forms.text-area>
                    <x-forms.text-area label="Preventative Measure" name="preventative_measure"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                      {{isset($fire_property) ? $fire_property->preventative_measure : ''}}
                    </x-forms.text-area>

                    <div class="mb-2">
                      <span id="addRecordButton" class="btn btn-sm btn-primary">Add</span>
                    </div>

                    <table class="table table-flush  table-bordered"  id="actionTable">
                        <thead class="thead-light">
                            <x-table.tblhead heads="Action,Timeline,Description,Status,X" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" ></x-table.tblhead>
                        </thead>
                        <tbody>

                          @if (isset($fire_property) && !empty($fire_property->actions))
                          @foreach ($fire_property->actions as $action)
                          <tr>
                            <td>
                              <input type="hidden" name="actions[{{$loop->iteration}}][sno]" value="{{$loop->iteration}}" />
                              <input type="text" class="form-control form-control-sm"     value="{{$action['action']}}" name="actions[{{$loop->iteration}}][action]"></td>
                            <td> <input type="text" class="form-control form-control-sm" value="{{$action['timeline']}}" name="actions[{{$loop->iteration}}][timeline]"></td>
                            <td> <input type="text" class="form-control form-control-sm" value="{{$action['description']}}"  name="actions[{{$loop->iteration}}][description]"></td>
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

                  <div class="row mt-3">
                    <x-forms.basic-input label="Invterviews" name="interview_attachs[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>
                    <x-forms.basic-input label="Records" name="record_attachs[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>
                    <x-forms.basic-input label="Photographs" name="photograph_attachs[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>
                    <x-forms.basic-input label="Other" name="other_attachs[]" type="file" multiple  width="col-12 col-sm-6" value="" input-class="multisteps-form__input"></x-forms.basic-input>

                  </div>


                  <div class="button-row d-flex mt-4">
                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                    <input type="hidden" name="redirect" value="{{url()->previous()}}">
                    @canany(['fire_property_damage.create','fire_property_damage.edit'])
                        
                    @endcanany
                    <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" type="submit" title="Send" data-style="expand-left">Send</button>
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
