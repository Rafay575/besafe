<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.partials.header')
  @include('layouts.partials.core_style')
  @yield('style')
</head>

<body class="g-sidenav-show bg-gray-100">

        {{-- loading indicator --}}
      <div id="main_loading" class=" bg-primary position-fixed w-100 h-100 d-block " style="z-index: 100; top:0; left:0; text-align: center;opacity: 0.5;z-index:999999">
        <img width="80px" src="{{asset('website/img/loader.gif')}}" alt="loading"
        style="
        position: absolute;
          top: 36%;
          left: 45%;
          z-index: 100;
        " 
        >
        <div class="spinner-grow text-danger"  role="status" style="
        position: absolute;
          top: 37%;
          left: 45%;
          z-index: 100;
          width: 5rem; height: 5rem;
        " >
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      {{-- loading indicator end here --}}


  @include('layouts.partials.site_nav')
  <main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
   @include('layouts.partials.header_nav')
    <!-- End Navbar -->
    {{-- Main contents  --}}
    <div class="container-fluid py-4">
      @yield('content')
      @include('layouts.partials.footer')
    </div>
   {{-- @include('layouts.partials.dashboard') --}}
   {{-- main conetns ends here --}}
  </main>
  @include('layouts.partials.ui_change')
  <!--   Core JS Files   -->
  @include('layouts.partials.core_script')

  @yield('script')

</body>

</html>

<script>
  // hide loadin
  $(window).on('load',function() {
    $('div#main_loading').removeClass('d-block');
    $('div#main_loading').addClass('d-none');
  });
</script>