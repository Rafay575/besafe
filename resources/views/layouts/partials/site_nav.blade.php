<div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">
        <img src="{{asset('website/img/logo.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">CMS</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        @can('dashboard.index')
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}" href="{{route('dashboard')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-shop text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        @endcan

       @can('user.index')
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link {{ (request()->is('users')) ? 'active' : '' }}" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/User.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1 ">Users Management</span>
          </a>
          <div class="collaps" id="dashboardsExamples"> {{-- add class show to this div if you want to expand it  --}}
            <ul class="nav ms-4">
              @can(['user.edit','user.index'])
              <li class="nav-item ">
                <a class="nav-link {{ (request()->is('users')) ? 'active' : '' }} " href="{{route('users.index')}}">
                  <span class="sidenav-mini-icon"> U </span>
                  <span class="sidenav-normal"> Users </span>
                </a>
              </li>
              @endcan

              @can(['role.index','role.edit'])
                
              <li class="nav-item ">
                <a class="nav-link " href="{{route('roles.index')}}">
                  <span class="sidenav-mini-icon"> RP</span>
                  <span class="sidenav-normal"> Roles and Permission </span>
                </a>
              </li>
              @endcan

            </ul>
          </div>
        </li>
       @endcan 


       @can('unsafe_behavior.index')
           
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('unsafe-behaviors')) ? 'active' : '' }}" href="{{route('unsafe-behaviors.index')}}" >
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Unsafe-Behaviour.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">Unsafe Behaviors</span>
          </a>
        </li>
        @endcan


        @can('hazard.index')
            
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('hazards')) ? 'active' : '' }}" href="{{route('hazards.index')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Unsafe-Behaviour.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">Hazards</span>
          </a>
        </li>
        @endcan



        @can('near_miss.index')
            
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('near-miss')) ? 'active' : '' }}" href="{{route('near-miss.index')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Near Miss.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">Near Miss</span>
          </a>
        </li>
        @endcan

        @can('fire_property_damage.index')
            
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('fire-property')) ? 'active' : '' }}" href="{{route('fire-property.index')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Fire Property Damage.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">Fire/Property Damage</span>
          </a>
        </li>

        @endcan


        @can('injury.index')
            
        <li class="nav-item">
          <a class="nav-link " href="{{route('injuries.index')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Injuries.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">Injuries</span>
          </a>
        </li>
        @endcan


        @can('ptw.index')
            
        <li class="nav-item">
          <a class="nav-link" href="{{route('ptws.index')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Permission-to-Work-System.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">PTW</span>
          </a>
        </li>
        @endcan

        {{-- <li class="nav-item">
          <a class="nav-link" href="#">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Internal External Audit Closures.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">Internal/External Audit Closures</span>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Management Walk Through Audits.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1"> Management Walk Through Audits
            </span>
          </a>
        </li> --}}

        @can('ie_audit_cluase.index')
            
        <li class="nav-item">
          <a class="nav-link" href="{{route('ie_audits.index')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Internal External Audit Closures.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">Int/Ext Audit Closures</span>
          </a>
        </li>
        @endcan


        @can('meta_data.index')
            
        <li class="nav-item">
          <a class="nav-link {{ (request()->is('meta-data')) ? 'active' : '' }}" href="{{route('meta-data.index')."?menu=departments"}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Meta-Data.ico')}}" alt="" width="18">
              
            </div>
            <span class="nav-link-text ms-1"> Meta Data </span>
          </a>
        </li>
        @endcan


        @can('report.index')            
        <li class="nav-item">
          <a class="nav-link" href="{{route('pdfreports.index')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset('website/nav_icons/Reports.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1"> Reports</span>
          </a>
        </li>

        @endcan


        @can('setting.index')
        <li class="nav-item">
          <a class="nav-link" href="{{route('about.show')}}">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
              {{-- <i class="text-primary text-sm opacity-10">

              </i> --}}
              <img src="{{asset('website/nav_icons/Settings.ico')}}" alt="" width="18">
            </div>
            <span class="nav-link-text ms-1">Settings</span>
          </a>
        </li>
        @endcan


        
      </ul>
    </div>
   
  </aside>