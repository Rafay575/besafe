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
                  <button class="multisteps-form__progress-btn" type="button" title="Section 3">Section 3</button>
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
                <h5 class="font-weight-bolder mb-0">Section 1 Fire / Property Demage</h5>
                {{-- <p class="mb-0 text-sm">Mandatory informations</p> --}}
                <div class="multisteps-form__content">
                  <div class="row mt-3">
                   <x-forms.basic-input label="Date" name="date" type="date" placeholder="" value="" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                   <x-forms.basic-input label="Reference" name="ref" type="text" placeholder="" value="" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input" required></x-forms.basic-input>
                  </div>
                  <div class="row mt-3">
                    <x-forms.selectoption name="unit" selectClass="form-control-sm" label="Unit" divClass="col-12 col-sm-6">
                        <option value="Value">Value 1</option>
                        <option value="Value">Value 1</option>
                    </x-forms.selectoption>
                   <x-forms.basic-input label="Location" name="location" type="text" placeholder="type location"  value="" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                  </div>
                  <div class="row mt-3">
                    <x-forms.radio-and-check-box-div name="fire_category" label="Fire Category" div-class="col-6">
                        <x-forms.radio-box width="col-2" radio-box-class="" name="fire_category" checked="false" label="A" value="A"></x-forms.radio-box>
                        <x-forms.radio-box width="col-2" radio-box-class="" name="fire_category" checked="false" label="B" value="B"></x-forms.radio-box>
                        <x-forms.radio-box width="col-2" radio-box-class="" name="fire_category" checked="false" label="C" value="C"></x-forms.radio-box>
                    </x-forms.radio-and-check-box-div>
                    <x-forms.radio-and-check-box-div name="property_demage" label="Property Demage" div-class="col-6">
                        <x-forms.radio-box width="col-2" radio-box-class="" name="property_demage" checked="false" label="A" value="A"></x-forms.radio-box>
                        <x-forms.radio-box width="col-2" radio-box-class="" name="property_demage" checked="false" label="B" value="B"></x-forms.radio-box>
                        <x-forms.radio-box width="col-2" radio-box-class="" name="property_demage" checked="false" label="C" value="C"></x-forms.radio-box>
                    </x-forms.radio-and-check-box-div>
                 </div>
                 <div class="row mt-3">
                    <x-forms.textarea label="Description" name="description"  width="col-6" text-area-class="" cols="" rows="3"></x-forms.textarea>
                    <x-forms.textarea label="Immediate Action" name="immediate_action"  width="col-6" text-area-class="" cols="" rows="3"></x-forms.textarea>
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
                <h5 class="font-weight-bolder">Section 2 Fire / Property Demage</h5>
                <div class="multisteps-form__content">
                  <div class="row mt-3">
                    <x-forms.textarea label="Immediate Cuase" name="immediate_cause"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                    <x-forms.textarea label="Root Cause" name="root_cause"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                  </div>
                  <div class="row mt-3">
                    <x-forms.textarea label="Has similar incident happend before?" name="similar_incident_details"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                    <x-forms.textarea label="Root Cause" name="root_cause"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
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
                           <x-forms.basic-input label="" name="direct_loss_desc" type="text" placeholder="description"  value="" width="col-12" input-class="multisteps-form__input" ></x-forms.basic-input>
                          </td>
                          <td>
                           <x-forms.basic-input label="" name="direct_loss_amount" type="number" placeholder="00"  value="" width="col-12 " input-class="multisteps-form__input" ></x-forms.basic-input>
                          </td>
                        </tr>
                        <tr>
                          <td><i class="badge badge-dark">InDirect Loss</i></td>
                          <td>
                           <x-forms.basic-input label="" name="direct_loss_desc" type="text" placeholder="description"  value="" width="col-12" input-class="multisteps-form__input" ></x-forms.basic-input>
                          </td>
                          <td>
                           <x-forms.basic-input label="" name="direct_loss_amount" type="number" placeholder="00"  value="" width="col-12 " input-class="multisteps-form__input" ></x-forms.basic-input>
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

                    <x-forms.textarea label="Loss Recovery Method" name="loss_recovery_method"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                    <x-forms.textarea label="Preventative Measure" name="preventative_measure"  width="col-6" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>

                    
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
