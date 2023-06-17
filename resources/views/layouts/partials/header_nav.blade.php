<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3 row">
      <div class="col-12 col-sm-6 d-flex">
          @yield('breadcrumb')
          <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none mt-3">
            <a href="javascript:;" class="nav-link p-0">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
              </div>
            </a>
          </div>
      </div>
      
        <div class="col-12 col-sm-6">
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item dropdown pe-2 px-5 mt-1 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="notification-icon">
                  <i class="badge badge-sm badge-secondary"  id="notification-badge"style="position: absolute; top: 18px; right: -16px; "></i>
                  <i class="fa fa-bell cursor-pointer"></i>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 notifications"  style="height: 300px; overflow-y: auto;" aria-labelledby="dropdownMenuButton">
               {{-- it is to be populated by ajax  --}}
                
              </ul>
            </li>
  
  
            <li class="nav-item px-4 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <a href="{{route('incidents.index')}}" class="btn btn-light btn-sm mt-3 p-2">Incidents Assign</a>
              </a>
            </li>
  
  
            <li class="nav-item  d-flex align-items-center">
              <div class="dropdown">
                <a href="/login" class="nav-link text-white font-weight-bold px-0" target="_blank" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                 @if (auth()->user()->image != "")
                 <img class="border-radius-lg avatar-sm" alt="profile" src="{{asset('images/profile/' . auth()->user()->image)}}">
                  @else 
                  <i class="fa fa-user me-sm-1"></i>
                 @endif
                  <span class="d-sm-inline d-none">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                   
                    <li>
                        <a class="dropdown-item" href="{{route('users.profileCreate')}}">Profile Settings</a>
                    </li>
                    
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"">Logout</a>
                    </li>
                    
                </ul>
              </div>
            </li>
                  
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
           
          </ul>
        </div>
      </div>
    </div>
  </nav>