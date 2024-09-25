<div class="min-height-300 bg-main-nav-rafay position-absolute w-100"></div>
<aside
    class="sidenav  bg-white-custom shadow-lg navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <img src="{{ asset('website/img/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">CMS</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @can('dashboard.index')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            @endcan

            @can('user.index')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link collapsed"
                        aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <img src="{{ asset('website/nav_icons/User.ico') }}" alt="" width="18">
                        </div>
                        <span class="nav-link-text ms-1 ">Users Management</span>
                    </a>
                    <div class="collapse" id="dashboardsExamples"> {{-- add class show to this div if you want to expand it
                        --}}
                        <ul class="nav ms-4">
                            @can(['user.edit', 'user.index'])
                                <li class="nav-item ">
                                    <a class="nav-link {{ request()->is('users') ? 'active' : '' }} "
                                        href="{{ route('users.index') }}">
                                        <!-- <span class="sidenav-mini-icon"> U </span> -->
                                        <span class="sidenav-normal"> Users </span>
                                    </a>
                                </li>
                            @endcan
                            @can(['employee.edit', 'employee.index'])
                                <li class="nav-item ">
                                    <a class="nav-link {{ request()->is('employees') ? 'active' : '' }} "
                                        href="{{ route('employees.index') }}">
                                        <!-- <span class="sidenav-mini-icon"> E </span> -->
                                        <span class="sidenav-normal"> Employees </span>
                                    </a>
                                </li>
                            @endcan
                            @can(['role.index', 'role.edit'])
                                <li class="nav-item ">
                                    <a class="nav-link " href="{{ route('roles.index') }}">
                                        <!-- <span class="sidenav-mini-icon"> RP</span> -->
                                        <span class="sidenav-normal"> Roles and Permission </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endcan

            @can(['ticket.index', 'ticket.edit'])
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tickets') ? 'active' : '' }}" href="{{ route('tickets.index') }}">
                        <div
                            class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ticket</span>
                    </a>
                </li>
            @endcan

            @can(['adminsetting.index', 'adminsetting.edit'])
                <li class="nav-item">
                    <hr class="horizontal dark">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('adminpanel') ? 'active' : '' }}" data-bs-toggle="collapse" href="#employeeSettings" class="nav-link" aria-controls="employeeSettings"
                    role="button" aria-expanded="true">
                        <div
                            class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                            <span class="text-primary  opacity-10 text-black">
                                <svg fill="inherit" width="15px" height="inherit" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 512 512" xml:space="preserve">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0">
                                    </g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <g>
                                                <path d="M235.082,392.745c-5.771,0-10.449,4.678-10.449,10.449v4.678c0,5.771,4.678,10.449,10.449,10.449 c5.77,0,
                                                         10.449-4.678,10.449-10.449v-4.678C245.531,397.423,240.853,392.745,235.082,392.745z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path
                                                    d="M492.948,313.357l-31.393-25.855c1.58-10.4,2.38-20.968,2.38-31.502c0-10.534-0.8-21.104-2.381-31.504l31.394-25.856
                                                      c10.032-8.262,12.595-22.42,6.099-33.66L456.35,91.029c-4.704-8.173-13.479-13.25-22.903-13.25c-3.19,0-6.326,0.573-9.302,1.695
                                                      l-38.109,14.274c-16.546-13.286-34.848-23.869-54.55-31.54l-6.683-40.082C322.676,9.306,311.701,0,298.704,0h-85.408
                                                      C200.3,0,189.324,9.307,187.2,22.119l-6.684,40.088c-19.703,7.673-38.007,18.255-54.553,31.542L87.898,79.492
                                                      c-2.999-1.138-6.14-1.715-9.338-1.715c-9.414,0-18.191,5.074-22.903,13.241l-42.702,73.96 c-6.499,11.244-3.935,25.403,6.097,
                                                      33.664l31.394,25.855c-1.58,10.4-2.38,20.969-2.38,31.503c0,10.534,0.8,21.103,2.38,31.503 l-31.394,25.856c-10.032,8.262-12.595
                                                      ,22.42-6.099,33.66l42.703,73.963c4.716,8.171,13.492,13.247,22.904,13.247 c3.205,0,6.352-0.581,9.294-1.703l38.107-14.275c16.547
                                                      ,13.287,34.85,23.87,54.551,31.541l6.682,40.075 C189.316,502.692,200.293,512,213.297,512h85.408c12.991,0,23.967-9.304,
                                                      26.096-22.118l6.683-40.089 c19.705-7.673,38.008-18.255,54.554-31.542l38.07,14.261c2.999,1.137,6.141,1.713,9.336,1.713c9.411,
                                                      0,18.185-5.074,22.9-13.241 l42.703-73.962C505.543,335.776,502.979,321.619,492.948,313.357z M298.704,491.102H245.53v-49.427
                                                       c0-5.771-4.678-10.449-10.449-10.449c-5.771,0-10.449,4.678-10.449,10.449v49.427h-10.922V376.504 c13.606,4.844,28.061,7.375,
                                                       42.865,7.382c0.003,0,0.066,0,0.07,0c14.852,0,29.325-2.528,42.928-7.376v114.515h0.001 C299.289,491.069,299,491.102,298.704,
                                                       491.102z M256.642,362.988h-0.057c-58.964-0.029-106.933-48.026-106.932-106.99 c0.001-34.314,16.175-65.814,43.158-85.745v76.229c0,3.671,1.926,7.072,5.073,8.96l53.381,32.027 c3.309,1.984,7.443,1.984,10.752,0l53.381-32.027c3.147-1.889,5.073-5.29,5.073-8.96v-76.229 c26.983,19.931,43.159,51.432,43.157,85.747c0,28.528-11.143,55.382-31.374,75.614 C312.022,351.846,285.169,362.988,256.642,362.988z M480.949,336.57l-42.705,73.965c-1.326,2.296-4.122,3.423-6.769,2.42 l-43.772-16.397c-3.557-1.331-7.555-0.63-10.444,1.834c-16.925,14.428-36.026,25.589-56.79,33.212v-64.779
                                                       c9.585-5.551,18.513-12.386,26.56-20.434c24.179-24.18,37.495-56.281,37.495-90.391c0.001-48.242-26.729-91.831-69.76-113.754 c-3.239-1.651-7.103-1.498-10.203,0.401c-3.099,1.9-4.989,5.274-4.989,8.909v89.011l-42.932,25.759l-42.932-25.759v-89.011 c0-3.635-1.89-7.009-4.989-8.909c-3.099-1.899-6.963-2.05-10.203-0.401c-43.03,21.922-69.76,65.51-69.762,113.752 c-0.001,34.743,13.583,67.154,38.247,91.26c7.858,7.68,16.53,14.23,25.809,19.585v65.235 c-21.258-7.63-40.795-18.958-58.071-33.684c-1.922-1.638-4.333-2.497-6.78-2.497c-1.232,0-2.473,0.217-3.663,0.664l-43.83,16.419 c-0.613,0.234-1.255,0.353-1.905,0.353c-1.969,0-3.81-1.071-4.805-2.796l-42.706-73.968c-1.365-2.361-0.822-5.337,1.288-7.076 L68.389,299.8c2.926-2.411,4.318-6.216,3.635-9.944c-2.03-11.12-3.061-22.509-3.061-33.856c0-11.346,1.03-22.736,3.063-33.854 c0.681-3.729-0.709-7.535-3.636-9.944l-36.051-29.691c-2.112-1.74-2.654-4.716-1.287-7.08l42.705-73.966 c1.323-2.294,4.109-3.429,6.769-2.419l43.772,16.396c3.555,1.33,7.554,0.63,10.444-1.833 c17.417-14.847,37.129-26.244,58.589-33.876c3.576-1.272,6.182-4.382,6.805-8.126l7.679-46.059 c0.446-2.694,2.752-4.649,5.482-4.649h85.408c2.73,0,5.036,1.955,5.485,4.656l7.679,46.053c0.624,3.744,3.23,6.856,6.806,8.126 c21.459,7.631,41.17,19.027,58.586,33.874c2.89,2.463,6.888,3.165,10.444,1.833l43.794-16.405c0.631-0.238,1.287-0.358,1.95-0.358 c1.97,0,3.805,1.064,4.798,2.789l42.706,73.967c1.365
                                                       ,2.361,0.822,5.337-1.288,7.076l-36.052,29.692 c-2.926,2.411-4.318,6.215-3.635,9.944c2.03,11.118,3.061,22.509,3.061,33.855c0,11.346-1.03,22.735-3.063,33.853 c-0.681,3.728,0.709,7.535,3.636,9.944l36.051,29.691C481.774,331.227,482.316,334.205,480.949,336.57z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <span class="nav-link-text ms-1">Admin Panel</span>
                    </a>
                </li>

                    <div class="collapse" id="employeeSettings" style="">
                        <ul class="nav ms-4">

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('businesshours') ? 'active' : '' }}"
                                    href="{{ route('businesshours.index') }}">
                                    <span class="nav-link-text ms-2">Business Hours</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('slapolicies') ? 'active' : '' }}"
                                    href="{{ route('slapolicies.index') }}">
                                    <span class="nav-link-text ms-2">SLA Policies</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('tickets') ? 'active' : '' }}"
                                    href="{{ route('tickets.index') }}">
                                    <span class="nav-link-text ms-2">Flexi Desk Settings</span>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link collapsed" data-bs-toggle="collapse" aria-expanded="false" href="#employeeSubSetting">
                                    <span class="nav-link-text ms-2"> Employee </span>
                                </a>
                                <div class="collapse " id="employeeSubSetting" style="">
                                    <ul class="nav nav-sm flex-column">
                                        @can('hazard.index')
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->is('designations') ? 'active' : '' }}"
                                                    href="{{ route('designations.index') }}">
                                                    <!-- <span class="sidenav-mini-icon"> D </span> -->
                                                    <span class="nav-link-text ms-1">Designation</span>
                                                </a>
                                            </li>
                                        @endcan
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('departments') ? 'active' : '' }}"
                                                href="{{ route('departments.index') }}">
                                                <!-- <span class="sidenav-mini-icon"> D </span> -->
                                                <span class="sidenav-normal"> Departments </span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('grades') ? 'active' : '' }}"
                                                href="{{ route('grades.index') }}">
                                                <!-- <span class="sidenav-mini-icon"> G </span> -->
                                                <span class="sidenav-normal"> Grade </span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('regions') ? 'active' : '' }}"
                                                href="{{ route('regions.index') }}">
                                                <!-- <span class="sidenav-mini-icon"> R </span> -->
                                                <span class="sidenav-normal"> Region </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item ">
                                <a class="nav-link collapsed " data-bs-toggle="collapse" aria-expanded="false" href="#ticketSetting">
                                    <span class="nav-link-text ms-2 "> Tickets </span>
                                </a>
                                <div class="collapse" id="ticketSetting" style="">
                                    <ul class="nav nav-sm flex-column">

                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('tickettypes') ? 'active' : '' }}"
                                                href="{{ route('tickettypes.index') }}">
                                                <!-- <span class="sidenav-mini-icon"> TT </span> -->
                                                <span class="sidenav-normal ms-1">Ticket Type</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('ticketsubtypes') ? 'active' : '' }}"
                                                href="{{ route('ticketsubtypes.index') }}">
                                                <!-- <span class="sidenav-mini-icon"> TST </span> -->
                                                <span class="sidenav-normal ms-1"> Ticket Sub Types </span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('ticketsetting') ? 'active' : '' }}"
                                                href="{{ route('ticketsetting.index') }}">
                                                <!-- <span class="sidenav-mini-icon"> TS </span> -->
                                                <span class="sidenav-normal ms-1"> Ticket Setting </span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </li>
            @endcan

        </ul>
    </div>

</aside>