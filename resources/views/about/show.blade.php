@extends('layouts.main')
@section('breadcrumb')
<x-templates.bread-crumb page-title="About Company Settings">
</x-templates.bread-crumb>
@endsection

@section('content')
  <x-templates.basic-page-temp page-title="Settings" page-desc="Company Information Settings">
    {{-- x-slot:pageheader referes to the second slot in one componenet --}}
      <x-slot:pageHeader>
        <div class="ms-auto my-auto mt-lg-0 mt-4">
          {{-- <div class="ms-auto my-auto">
            <a href="{{route('hazards.create')}}" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; New hazard</a>
            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
          </div> --}}
        </div>
      </x-slot>
      {{-- x slot page header ends here --}}

      {{-- default slot starts here --}}
        <div class="row container">
          <div class="col-md-8">
          <form  action="{{route('about.update')}}" 
              method="post" enctype="multipart/form-data" class="ajax-form">
            @csrf
            @method('put')
              <div class="row">
                <div class="col-md-4 ">
                <label class="col-form-label">Company Name</label>
                <input required type="text" class="form-control" name="name" value="{{$about->name}}"  placeholder="Company Name" />
              @error('name')
                <span class=" text-danger">{{$errors->first('name')}}</span>
              @enderror                      
              </div>

                <div class="col-md-4">
                  <label class="col-form-label">Description</label>
                  <input required type="text" class="form-control" name="description" value="{{$about->description}}"  placeholder="description" />
                @error('description')
                  <span class=" text-danger">{{$errors->first('description')}}</span>
                @enderror                      
                </div>
                <div class="col-md-4">
                  <label class="col-form-label">Phone</label>
                  <input required type="text"  class="form-control" name="phone" value="{{$about->phone}}"  placeholder="Phone" />
                @error('phone')
                  <span class=" text-danger">{{$errors->first('phone')}}</span>
                @enderror                      
                </div>
                <div class="col-md-4">
                  <label class="col-form-label">Email</label>
                  <input required type="email" class="form-control" name="email" value="{{$about->email}}" placeholder="Email" />
                @error('email')
                  <span class=" text-danger">{{$errors->first('email')}}</span>
                @enderror                      
                </div>
                <div class="col-md-4">
                  <label class="col-form-label">Fax</label>
                  <input required type="text" class="form-control" name="fax" value="{{$about->fax}}" placeholder="Fax" />
                @error('fax')
                  <span class=" text-danger">{{$errors->first('fax')}}</span>
                @enderror                      
                </div>
                <div class="col-md-4">
                  <label class="col-form-label">Mailing</label>
                  <input required type="text" class="form-control" name="mailing" value="{{$about->mailing}}" placeholder="Mailing" />
                @error('mailing')
                  <span class=" text-danger">{{$errors->first('mailing')}}</span>
                @enderror                      
                </div>

                <div class="col-md-6">
                  <label class="col-form-label">Address</label>
                  <input required type="text" class="form-control" name="address" value="{{$about->address}}" placeholder="address" />
                @error('address')
                  <span class=" text-danger">{{$errors->first('address')}}</span>
                @enderror                      
                </div>
                <div class="col-md-6">
                  <label class="col-form-label">Website</label>
                  <input required type="url" class="form-control" name="website" value="{{$about->website}}" placeholder="Website" />
                @error('website')
                  <span class=" text-danger">{{$errors->first('website')}}</span>
                @enderror                      
                </div>
                <div class="col-md-12">
                  <label class="col-form-label">Details</label>
                  <textarea name="detail" class="form-control">{{$about->detail}}</textarea>
                @error('website')
                  <span class=" text-danger">{{$errors->first('website')}}</span>
                @enderror                      
                </div>
                <div class="col-md-6">
                  <label class="col-form-label">Full Logo</label>
                  <input  type="file" class="form-control p-1" name="full_logo"/>
                  @error('full_logo')
                  <span class=" text-danger">{{$errors->first('full_logo')}}</span>
                @enderror
                </div>
                <div class="col-md-6">
                  <label class="col-form-label">Mini Logo</label>
                  <input  type="file" class="form-control p-1" name="mini_logo"/>
                  @error('mini_logo')
                  <span class=" text-danger">{{$errors->first('mini_logo')}}</span>
                @enderror
                </div>

                <div class="col-md-6">
                  <label class="col-form-label">Loader</label>
                  <input  type="file" class="form-control p-1" name="loader"/>
                  @error('loader')
                  <span class=" text-danger">{{$errors->first('loader')}}</span>
                  @enderror
                </div>

              </div>
              {{--form row end above  --}}
              <div class="form-group mt-5">
                <input type="hidden" value="{{url()->current()}}" name="redirect" >
                @can('setting.edit')
                 <button class="btn btn-primary btn-ladda" type="submit" name="add" data-style="expand-right">Update</button>
                @endcan
              </div>                                    

            </form>
          </div>

          <div class="col-sm-4">
            <div class="w-100 py-4">
              <h5>Full logo</h5>
              <img src="{{asset('website/img/logo.png')}}" alt="Full logo" width="100%">
            {{-- </div> --}}
            {{-- <div class="py-4"> --}}
              <h5 class="mt-5">Mini Logo</h5>
              <img src="{{asset('website/img/logo-mini.png')}}" alt="Full logo" width="25%">

              <h5 class="mt-5">Loader</h5>
              <img src="{{asset('website/img/loader.gif')}}" alt="Full logo" width="40%">
            </div>            
          </div>

        </div>
      {{-- defautl slot end here --}}

   </x-templates.basic-page-temp>

@endsection
