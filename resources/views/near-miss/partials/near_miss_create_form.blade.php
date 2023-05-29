<div class="row">
  <div class="col-12 mx-auto">
    <div class="multisteps-form mb-5 mx-auto">
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
                <button class="multisteps-form__progress-btn" type="button" title="Recommendation">Recommendation</button>
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
            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
              <h5 class="font-weight-bolder mb-0">Section 1 Near Miss</h5>
              {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
              <div class="multisteps-form__content">
                <div class="row mt-3">
                
                <x-forms.basic-input label="Date" name="date" type="date" value="{{(isset($near_miss) ? Carbon\Carbon::parse($near_miss->date)->format('Y-m-d') : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                <x-forms.basic-input label="Date" name="time" type="time" value="{{(isset($near_miss) ? Carbon\Carbon::parse($near_miss->time)->format('H:i') : '')}}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                </div>
                <div class="row mt-3">
                 <x-forms.basic-input label="Location" name="location" type="text" placeholder="type location"  value="{{ isset($near_miss) ? $near_miss->location : '' }}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                 <x-forms.text-area label="Incident Description" name="description"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                    {{isset($near_miss) ? $near_miss->description : ''}}
                 </x-forms.text-area>
                 {{-- <x-forms.basic-input label="Injured Person" name="injured_person" type="text" placeholder="eg. Ali" value="" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input"></x-forms.basic-input> --}}
                </div>
                 
                <div class="row mt-3">
                     <x-forms.text-area label="Immediate Action" name="immediate_action"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2">
                      {{isset($near_miss) ? $near_miss->immediate_action : ''}}
                     </x-forms.text-area>
                     
                     <x-forms.select-option name="meta_incident_status_id" selectClass="form-control-sm" label="Status" divClass="col-12 col-sm-6">
                       @foreach ($incident_statuses as $status)
                       <option value="{{$status->id}}" {{ isset($near_miss) && $near_miss->meta_incident_status_id == $status->id ? 'selected' : '' }}>{{$status->status_title}}</option>
                     @endforeach
                    </x-forms.select-option>
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
            </div>
            <!--single form panel-->
            <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
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
                  <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" id="submit-button" type="submit" title="Send" data-style="expand-left">Send</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> 

