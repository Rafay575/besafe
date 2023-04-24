<div class="row mb-10">
    <div class="col-12 mb-10">
      <div class="multisteps-form mb-5">
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
            <form class="multisteps-form__form mb-8 ajax-form" action="{{route('users.store')}}" method="post">
              @csrf
              <!--single form panel-->
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                <h5 class="font-weight-bolder mb-0">Stage 1</h5>
                {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
                <div class="multisteps-form__content">
                  
                  <div class="row mt-3">
                    <x-forms.selectoption name="incident_category" selectClass="form-control-sm multisteps-form__input" label="Incident Category" divClass="col-12 col-sm-6">
                        <option value="Value">Value 1</option>
                        <option value="Value">Value 1</option>
                    </x-forms.selectoption>
                    <x-forms.selectoption name="injury_category" selectClass="form-control-sm multisteps-form__input" label="Injury Category" divClass="col-12 col-sm-6">
                        <option value="Value">Value 1</option>
                        <option value="Value">Value 1</option>
                    </x-forms.selectoption>
                  </div>
                  <div class="row mt-3">
                    <x-forms.basic-input label="Employee Involved" name="employee_involved" type="text" placeholder="name"  value="" width="col-12 col-sm-4" input-class="multisteps-form__input" ></x-forms.basic-input>
                    <x-forms.basic-input label="Witness" name="witness" type="text" placeholder="Witness name"  value="" width="col-12 col-sm-4" input-class="multisteps-form__input" ></x-forms.basic-input>
                    <x-forms.radio-and-check-box-div name="sgfl_relation" label="Relationship to SGFL" div-class="col-3">
                        <x-forms.radio-box width="col-2" radio-box-class="" name="sgfl_relation" checked="false" label="Employee" value="Employee"></x-forms.radio-box>
                        <x-forms.radio-box width="col-2" radio-box-class="" name="sgfl_relation" checked="false" label="Contractor" value="Contractor"></x-forms.radio-box>
                    </x-forms.radio-and-check-box-div>
                    
                 </div>
                 <div class="row mt-3">
                    <x-forms.textarea label="Description" name="description"  width="col-6" text-area-class="" cols="" rows="3"></x-forms.textarea>
                    <x-forms.textarea label="Immediate Actions" name="immediate_action"  width="col-6" text-area-class="" cols="" rows="3"></x-forms.textarea>
                 </div>
                
                 <div class="button-row d-flex mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                  </div>

                 <div class="row mt-3 mb-6 dropzone" id="dropzone">
                    <div class="dz-message" data-dz-message><span class="text-secondary">Drop related Images here or Tap to upload</span></div>
                     <div class="fallback mb-6">
                        <input name="file" type="file" multiple class="form-control multisteps-form__input" />
                      </div>
                 </div>
                  
                </div>
              </div>
              <!--single form panel-->
            
              <!--single form panel-->
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                <h5 class="font-weight-bolder">Stage 2</h5>
                <div class="multisteps-form__content mt-3">
                  <div class="row mt-3">
                    <x-forms.textarea label="Key Findings" name="key_finding"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                    <x-forms.textarea label="Preventative Measure" name="preventative_measure"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                  </div>

                  <div class="row mt-3">
                    <x-forms.selectoption name="substandard_actions" selectClass="form-control-sm multisteps-form__input" label="Substandard Actions" divClass="col-12 col-sm-6">
                        <option value="Value">Action 1</option>
                        <option value="Value">Action 1</option>
                    </x-forms.selectoption>

                    <x-forms.selectoption name="substandard_condition" selectClass="form-control-sm multisteps-form__input" label="Substandard Conditions" divClass="col-12 col-sm-6">
                        <option value="Value">Conditon 1</option>
                        <option value="Value">Condition 2</option>
                    </x-forms.selectoption>
                  </div>

                  <div class="row mt-3">
                    <x-forms.selectoption name="basic_claue" selectClass="form-control-sm multisteps-form__input" label="Basic Clause" divClass="col-12 col-sm-6">
                        <option value="Value">Clause 1</option>
                        <option value="Value">Clause 1</option>
                    </x-forms.selectoption>

                    <x-forms.selectoption name="contract_type" selectClass="form-control-sm multisteps-form__input" label="Type of Contract" divClass="col-12 col-sm-6">
                        <option value="Value">type 1</option>
                        <option value="Value">type 2</option>
                    </x-forms.selectoption>
                  </div>
                  <div class="row mt-3">
                    <x-forms.textarea label="Root Cause" name="root_cause"  width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                  </div>
                  <div class="row mt-3">
                    <table class="table table-flush  table-bordered">
                        <thead class="thead-light">
                            <x-table.tblhead heads="Sr.,Action,Desp,Timeline,Status" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" ></x-table.tblhead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                        
                  </div>
                  <div class="button-row d-flex mt-4">
                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
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
