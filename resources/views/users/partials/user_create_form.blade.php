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
            @if(isset($user))
            <form class="multisteps-form__form mb-8 ajax-form" action="{{ route('users.update', $user->id) }}" method="POST">
              @method('PUT')
          @else
            <form class="multisteps-form__form mb-8 ajax-form" action="{{ route('users.store') }}" method="POST">
          @endif
              @csrf
             <!--single form panel-->
             <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
              <h5 class="font-weight-bolder mb-0">About User</h5>
              <p class="mb-0 text-sm">Mandatory information</p>
              <div class="multisteps-form__content">
                <div class="row mt-3">
                  <x-forms.basic-input label="First Name" name="first_name" type="text" placeholder="eg. Ali" value="{{ isset($user) ? $user->first_name : '' }}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                  <x-forms.basic-input label="Last Name" name="last_name" type="text" placeholder="eg. Zeb" value="{{ isset($user) ? $user->last_name : '' }}" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input" required></x-forms.basic-input>
                </div>
                <div class="row mt-3">
                  <x-forms.basic-input label="Mobile" name="mobile" type="text" placeholder="eg. xxx-xxxxxxx" pattern="\d{3}-?\d{2}-?\d{4}" value="{{ isset($user) ? $user->mobile : '' }}" width="col-12 col-sm-6" input-class="multisteps-form__input" required></x-forms.basic-input>
                  <x-forms.basic-input label="Email" name="email" type="email" placeholder="eg. ali.zeb@gmail.com" value="{{ isset($user) ? $user->email : '' }}" width="col-12 col-sm-6 mt-3 mt-sm-0" input-class="multisteps-form__input"></x-forms.basic-input>
                </div>
                <div class="row mt-3">
                  <div class="col-6 row">
                    <x-forms.text-area label="Permanent Address" name="perm_address" width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2">{{ isset($user) ? $user->perm_address : '' }}</x-forms.text-area>
                    <x-forms.text-area label="Residential Address" name="res_address" width="col-12" text-area-class="multisteps-form__input" cols="2" rows="2">{{ isset($user) ? $user->res_address : '' }}</x-forms.text-area>
                  </div>
                  <div class="col-6 row">
                    <img src="{{ (isset($user) && $user->image != "") ? asset('images/profile/' . $user->image) : asset('images/profile/User.ico') }}" class="w-50 p-2 m-auto" width="10%"  alt="avatar"><br>
                    <x-forms.basic-input label="" name="image" type="file" placeholder="" value="" width="col-12" input-class="multisteps-form__input"></x-forms.basic-input>
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
                      <x-forms.select-option name="meta_unit_id" selectClass="form-control-sm" divClass="col-6" label="Unit" required>
                        @foreach ($units as $unit)
                          <option value="{{ $unit->id }}" {{ isset($user) && $user->meta_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->unit_title }}</option>
                        @endforeach
                      </x-forms.select-option>
                      <x-forms.select-option name="meta_designation_id" selectClass="form-control-sm" divClass="col-6" label="Designation" required>
                        @foreach ($designations as $designation)
                          <option value="{{ $designation->id }}" {{ isset($user) && $user->meta_designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->designation_title }}</option>
                        @endforeach
                      </x-forms.select-option>
                      <x-forms.select-option name="meta_department_id" selectClass="form-control-sm" divClass="col-6" label="Department" required>
                        @foreach ($departments as $department)
                          <option value="{{ $department->id }}" {{ isset($user) && $user->meta_department_id == $department->id ? 'selected' : '' }}>{{ $department->department_title }}</option>
                        @endforeach
                      </x-forms.select-option>
                      <x-forms.select-option name="meta_line_id" selectClass="form-control-sm" divClass="col-6" label="Line" required>
                        @foreach ($lines as $line)
                          <option value="{{ $line->id }}" {{ isset($user) && $user->meta_line_id == $line->id ? 'selected' : '' }}>{{ $line->line_title }}</option>
                        @endforeach
                      </x-forms.select-option>
                    </div>
                    <div class="row">
                      <div class="button-row d-flex mt-4 col-12">
                        <button class="btn bg-gradient-dark me-auto js-btn-prev" type="button" title="Previous">Previous</button>
                        <button class="btn bg-gradient-dark ms-auto js-btn-next" type="button" title="Next">Next</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!--single form panel-->


              <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100" data-animation="FadeIn">
                <h5 class="font-weight-bolder">User Credential</h5>
                <div class="multisteps-form__content mt-3">
                  <div class="row mt-3">
                    <x-forms.select-option name="roles" selectClass="form-control-sm" divClass="col-6" label="Role" required>
                      @foreach ($roles as $role)
                      <option value="{{ $role->name }}" {{ isset($user) && count($user->roles) > 0 && $user->roles->first()->id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                      @endforeach
                    </x-forms.select-option>
                    <x-forms.select-option name="status" selectClass="form-control-sm" divClass="col-6" label="Status" required>
                      <option value="1" {{ isset($user) && $user->status == 1 ? 'selected' : '' }}>Active</option>
                      <option value="0"  {{ isset($user) && $user->status == 0 ? 'selected' : '' }}>InActive</option>
                    </x-forms.select-option>

                    <x-forms.basic-input label="Password" name="password" type="password" placeholder="password" value="" width="col-6" input-class="multisteps-form__input" :required="!isset($user)"></x-forms.basic-input>
                    <x-forms.basic-input label="Confirm Password" name="password_confirmation" type="password" placeholder="confirm password" value="" width="col-6" input-class="multisteps-form__input" :required="!isset($user)"></x-forms.basic-input>
                   <div class="form-group col-6 mb-4">
                     <button type="button" class="btn btn-sm btn-success multisteps-form__input mt-2" id="auto_generate_pass">Auto Generate Password</button>
                      <span id="generated_password"></span>
                    </div>
                    
                  </div>
                  <div class="button-row d-flex mt-4">
                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                    <input type="hidden" name="redirect" value="{{url()->previous()}}">
                    <button class="btn bg-gradient-dark ms-auto mb-0 btn-ladda" type="submit" title="Send" data-style="expand-left">Submit</button>
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
