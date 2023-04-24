@extends('layouts.main')
@section('breadcrumb')
<x-templates.breadcrumb page-title="User Create">
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="{{route('users.index')}}">Users List</a></li>
</x-templates.breadcrumb>
@endsection

@section('content')
{{-- <x-templates.basic-page-temp page-title="Users List" page-desc="List of Registered Users"> --}}
        {{-- x-slot:pageheader referes to the second slot in one componenet --}}
        {{-- <x-slot:pageHeader>
          <div class="ms-auto my-auto mt-lg-0 mt-4">
            <div class="ms-auto my-auto">
              <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#recordCreate">+&nbsp; Add</a>
              <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
            </div>
          </div>
        </x-slot> --}}
        {{-- x slot page header ends here --}}
        @include('users.partials.user_create_form')
{{-- </x-templates.basic-page-temp>  --}}
@endsection
@section('script')
<script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>
<script>
  // auto generate password script starts here
  let el_down = $('span#generated_password');
  /* Function to generate combination of password */
  function generateP() {
    let firstname = $('input#first_name').val();
    if (firstname.length < 6) {
      firstname = 'besafe'
    }
      var pass = '';
      // var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' +
      //         'abcdefghijklmnopqrstuvwxyz0123456789@#$';
      // for (let i = 1; i <= 8; i++) {
      //     var char = Math.floor(Math.random()
      //                 * str.length + 1);
            
      //     pass += str.charAt(char)
    // }
    pass = firstname + 1 + Math.floor(Math.random() * 6) +Math.floor(Math.random() * 3);
        
      return pass;
  }
    
  function gfg_Run() {
    const password = generateP();
      el_down.empty().append(password);
      $('input#password').val(password);
      $('input#password_confirmation').val(password).select();
      document.execCommand("copy");
  }
  $('button#auto_generate_pass').on('click',function(){
    gfg_Run();
    Swal.fire(
      'Password copied to clipboard',
      '',
      'success'
    )
  });
  // auto generate password scripts ends here
</script>   
@endsection