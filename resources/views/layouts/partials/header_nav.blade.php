<nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      @yield('breadcrumb')
      <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
        <a href="javascript:;" class="nav-link p-0">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line bg-white"></i>
            <i class="sidenav-toggler-line bg-white"></i>
            <i class="sidenav-toggler-line bg-white"></i>
          </div>
        </a>
      </div>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <a href="{{route('incidents.index')}}" class="btn btn-light btn-sm mt-3">Incidents Assign</a>
        </div>
        <ul class="navbar-nav  justify-content-end">
          @auth
          <li class="nav-item d-flex align-items-center">
            <a href="/login" class="nav-link text-white font-weight-bold px-0" target="_blank">
              <i class="fa fa-user me-sm-1"></i>
              <span class="d-sm-inline d-none">{{auth()->user()->name}}</span>
            </a>
          </li>
                
            @endauth
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
              </div>
            </a>
          </li>
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0">
              <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
          </li>
          <li class="nav-item dropdown pe-2 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="notification-icon">
                <i class="badge badge-sm badge-secondary"  id="notification-badge"style="position: absolute; top: 15px; right: -12px; "></i>
                <i class="fa fa-bell cursor-pointer"></i>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 notifications"  style="height: 300px; overflow-y: auto;" aria-labelledby="dropdownMenuButton">
             {{-- it is to be populated by ajax  --}}
              
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>