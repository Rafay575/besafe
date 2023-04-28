<div class="row mb-10">
    <div class="col-12 mb-10">
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
                  <button class="multisteps-form__progress-btn" type="button" title="Recommendation">Recommendation</button>
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
                <h5 class="font-weight-bolder mb-0">Section 1 Near Miss</h5>
                {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
                <div class="multisteps-form__content">
                  <div class="row mt-3">
                   <x-forms.basic-input label="Date" name="date" type="date" placeholder="" value="" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                   <x-forms.basic-input label="Time" name="time" type="time" placeholder="" value="" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input" required></x-forms.basic-input>
                  </div>
                  <div class="row mt-3">
                   <x-forms.basic-input label="Location" name="location" type="text" placeholder="type location"  value="" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                   <x-forms.text-area label="Incident Description" name="incident_desc"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.text-area>
                   {{-- <x-forms.basic-input label="Injured Person" name="injured_person" type="text" placeholder="eg. Ali" value="" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input"></x-forms.basic-input> --}}
                  </div>
                  <div class="row mt-3">
                    
                  </div>
                  <div class="row mt-3">
                       <x-forms.text-area label="Immediate Action" name="immediate_action"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.text-area>
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
                <h5 class="font-weight-bolder">Section 2 Near Miss</h5>
                <div class="multisteps-form__content">
                  <div class="row mt-3">
                    <x-forms.text-area label="Immediate Cuase" name="immediate_cause"  width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.text-area>
                    <x-forms.text-area label="Root Cause" name="root_cause"  width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.text-area>
                   
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
                    
                    <table class="table table-flush  table-bordered">
                        <thead class="thead-light">
                            <x-table.tblhead heads="S.No,Description,Responsibility,Timeline,Status" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" ></x-table.tblhead>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">1</span>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_desc_1" type="text" placeholder="Description here"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_resp_1" type="text" placeholder="Responsibility"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_timeline_1" type="text" placeholder="Timeline"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                   <select name="recmd_status_1" id="" class="form-control form-control-sm">
                                    <option value="">Active</option>
                                    <option value="">InActive</option>
                                   </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">2</span>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_desc_2" type="text" placeholder="Description here"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_resp_2" type="text" placeholder="Responsibility"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_timeline_2" type="text" placeholder="Timeline"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                   <select name="recmd_status_2" id="" class="form-control form-control-sm">
                                    <option value="">Active</option>
                                    <option value="">InActive</option>
                                   </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">3</span>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_desc_3" type="text" placeholder="Description here"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_resp_3" type="text" placeholder="Responsibility"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                     <x-forms.basic-input label="" name="recmd_timeline_3" type="text" placeholder="Timeline"  value="" width="" input-class="form-control-sm"></x-forms.basic-input>
                                </td>
                                <td>
                                   <select name="recmd_status_3" id="" class="form-control form-control-sm">
                                    <option value="">Active</option>
                                    <option value="">InActive</option>
                                   </select>
                                </td>
                            </tr>
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
