<div class="row mb-10">
    <div class="col-12 mb-10">
      <div class="multisteps-form mb-5">
        <!--progress bar-->
        <div class="row">
          <div class="col-12 col-lg-8 mx-auto my-4">
            <div class="card">
              <div class="card-body">
                <div class="multisteps-form__progress">
                  <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                    <span>User Info</span>
                  </button>
                  <button class="multisteps-form__progress-btn" type="button" title="Work Place">Work Place</button>
                  <button class="multisteps-form__progress-btn" type="button" title="User Credential">User Credential</button>
                  {{-- <button class="multisteps-form__progress-btn" type="button" title="Profile">Profile</button> --}}
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
                <h5 class="font-weight-bolder mb-0">About User</h5>
                <p class="mb-0 text-sm">Mandatory informations</p>
                <div class="multisteps-form__content">
                  <div class="row mt-3">
                   <x-forms.basic-input label="First Name" name="first_name" type="text" placeholder="eg. Ali" value="" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                   <x-forms.basic-input label="Last Name" name="last_name" type="text" placeholder="eg. Zeb" value="" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input" required></x-forms.basic-input>
                  </div>
                  <div class="row mt-3">
                   <x-forms.basic-input label="Mobile" name="mobile_no" type="text" placeholder="eg. xxx-xxxxxxx" pattern="\d{3}-?\d{2}-?\d{4}" value="" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                   <x-forms.basic-input label="Email" name="email" type="email" placeholder="eg. ali.zeb@gmail.com" value="" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input"></x-forms.basic-input>
                  </div>
                  <div class="row mt-3">
                     <div class="col-6 row">
                       <x-forms.textarea label="Permanent Address" name="p_address"  width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                       <x-forms.textarea label="Residential Address" name="r_address"  width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2"></x-forms.textarea>
                     </div>
                      <div class="col-6 row">
                       <img src="{{asset('website/img/logo.png')}}" class="col-12" alt="avatar"><br>
                        <x-forms.basic-input label="" name="user_image" type="file" placeholder="" value="" width="col-12" input-class="multisteps-form__input" required></x-forms.basic-input>

                      </div>
                    </div>
                  <div class="button-row d-flex mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                  </div>
                </div>
              </div>
              <!--single form panel-->
              
              <!--single form panel-->
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                <h5 class="font-weight-bolder">Work Place</h5>
                <div class="multisteps-form__content">
                  <div class="row mt-3">
                    <x-forms.select-option name="unit" selectClass="form-control-sm" divClass="col-6" label="Unit" required>
                      <option value="Unit 1">Unit 1</option>
                    </x-forms.select-option>
                    <x-forms.select-option name="designation" selectClass="form-control-sm" divClass="col-6" label="Designation" required>
                      <option value="Designation 1 ">Designation 1</option>
                    </x-forms.select-option>
                    <x-forms.select-option name="department" selectClass="form-control-sm" divClass="col-6" label="Department" required>
                      <option value="Department 1">Department 1</option>
                    </x-forms.select-option>
                    <x-forms.select-option name="line" selectClass="form-control-sm" divClass="col-6" label="Line" required>
                      <option value="line 1 ">line 1</option>
                    </x-forms.select-option>
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
              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100" data-animation="FadeIn">
                <h5 class="font-weight-bolder">User Credential</h5>
                <div class="multisteps-form__content mt-3">
                  <div class="row mt-3">
                    <x-forms.select-option name="role" selectClass="form-control-sm" divClass="col-6" label="Role" required>
                      <option value="">Employee</option>
                      <option value="">Admin</option>
                    </x-forms.select-option>
                    <x-forms.select-option name="status" selectClass="form-control-sm" divClass="col-6" label="Status" required>
                      <option value="">Active</option>
                      <option value="">InActive</option>
                    </x-forms.select-option>

                    <x-forms.basic-input label="Password" name="password" type="password" placeholder="password" value="" width="col-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                    <x-forms.basic-input label="Confirm Password" name="password_confirmation" type="password" placeholder="confirm password" value="" width="col-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                   <div class="form-group col-6 mb-4">
                     <button type="button" class="btn btn-sm btn-success multisteps-form__input mt-2" id="auto_generate_pass">Auto Generate Password</button>
                      <span id="generated_password"></span>
                    </div>
                    
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
