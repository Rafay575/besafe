<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.partials.header')
  @include('layouts.partials.core_style')
  @yield('style')
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('layouts.partials.site_nav')
  <main class="main-content position-relative border-radius-lg ">
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