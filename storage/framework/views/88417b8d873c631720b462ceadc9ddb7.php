<div class="row">
    <div class="col-lg-12">
        <div class="row mb-3">
            <div class="col-1 col-sm-6"></div>
            <!-- <div class="col-sm-3 col-5">
          <input class="form-control datepicker" placeholder="Please select date" type="text" onfocus="focused(this)" onfocusout="defocused(this)">
        </div>
        <div class="nav-wrapper position-relative end-0 col-6 col-sm-3" style="cursor: pointer">
          <ul class="nav nav-pills nav-fill p-1" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active" id="data_by" data-data_by="daily" data-bs-toggle="tab"  role="tab" aria-controls="daily" aria-selected="true">
                  Daily
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" id="data_by" data-bs-toggle="tab" data-data_by="monthly"  role="tab" aria-controls="monthly" aria-selected="false">
                  Monthly
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1" id="data_by" data-bs-toggle="tab" data-data_by="yearly"  role="tab" aria-controls="yearly" aria-selected="false">
                  Yearly
                </a>
            </li>
          </ul>
        </div> -->
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card  mb-4">
                    <div class="card-body bg-white-custom border-radius-md p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">OPEN</p>
                                    <h5 class="font-weight-bolder">
                                        <?php echo e($incidentStats['open']); ?>

                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div
                                    class="icon icon-shape d-flex justify-content-center align-items-center  bg-gradient-secondary shadow-secondary  rounded-circle">
                                    <span class=" opacity-10">

                                        <svg width="30px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M20 19C20 19.5523 19.5523 20 19 20H5C4.44772 20 4 19.5523 4 19V11.2268L10.0069 16.5663C11.1436 17.5767 12.8564 17.5767 13.9931 16.5663L20 11.2268V19ZM4.56205 8.99999H19.438L12.6402 3.33519C12.2693 3.02615 11.7307 3.02615 11.3598 3.33519L4.56205 8.99999ZM6.7552 11L11.3356 15.0715C11.7145 15.4083 12.2855 15.4083 12.6644 15.0715L17.2448 11H6.7552ZM19 22C20.6569 22 22 20.6568 22 19V8.99999C22 8.70321 21.8682 8.42177 21.6402 8.23177L13.9206 1.79875C12.808 0.871631 11.192 0.871633 10.0794 1.79875L2.35982 8.23177C2.13182 8.42177 2 8.70321 2 8.99999V19C2 20.6568 3.34315 22 5 22H19Z"
                                                    fill="#ffffff"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card  mb-4">
                    <div class="card-body bg-white-custom border-radius-md p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">IN PROGRESS</p>
                                    <h5 class="font-weight-bolder">
                                        <?php echo e($incidentStats['in_progress']); ?>

                                    </h5>

                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div
                                    class="icon icon-shape d-flex justify-content-center align-items-center bg-gradient-success shadow-success text-center rounded-circle">
                                    <span class=" opacity-10">

                                    </span><svg fill="#ffffff" width="25px" version="1.1" id="XMLID_103_"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 24 24" xml:space="preserve" stroke="#ffffff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g id="in-progress">
                                                <g>
                                                    <path
                                                        d="M23,24H1v-2h2.4c-1.6-5,1.6-7,3.7-8.4C8,13,8.9,12.5,8.9,12S8,10.9,7.1,10.4C5,9,1.8,7.1,3.4,2H1V0h22v2h-2.4 c1.6,5-1.6,7-3.7,8.4c-1,0.5-1.9,1.1-1.9,1.6s0.9,1.1,1.8,1.6c2.1,1.4,5.3,3.4,3.7,8.4H23V24z M5.6,22h12.8c1.6-4-0.5-5.3-2.6-6.7 C14.4,14.5,13,13.6,13,12c0-1.6,1.4-2.5,2.8-3.3C17.9,7.3,20,6,18.4,2H5.6C4,6,6.1,7.3,8.2,8.7C9.6,9.5,11,10.4,11,12 c0,1.6-1.4,2.5-2.8,3.3C6.1,16.7,4,18,5.6,22z">
                                                    </path>
                                                </g>
                                                <g>
                                                    <path
                                                        d="M16.8,23H7c-0.3-1.5,0.2-2.4,2.3-4.3c0.8-0.7,1.8-1.5,2.7-2.8c1,1.2,2,2.1,2.7,2.8C16.8,20.7,17.3,21,16.8,23z">
                                                    </path>
                                                </g>
                                                <g>
                                                    <path
                                                        d="M9.4,6c-0.7,1.3-0.7,1.3,0.9,2.1c0.5,0.2,1.1,0.5,1.6,0.9c0.5-0.4,1.2-0.7,1.6-0.9c1.7-0.8,1.7-0.8,1-2.1">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card  mb-4">
                    <div class="card-body  bg-white-custom border-radius-md  p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">CLOSED</p>
                                    <h5 class="font-weight-bolder">
                                        <?php echo e($incidentStats['closed']); ?>


                                    </h5>

                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div
                                    class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="<i fa fa-xmark text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card  mb-4">
                    <div class="card-body bg-white-custom border-radius-md  p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Feedback</p>
                                    <h5 class="font-weight-bolder">
                                        <?php echo e($incidentStats['feedback']); ?>

                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div
                                    class="icon icon-shape d-flex justify-content-center align-items-center bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <span class="opacity-10">

                                        <svg fill="#ffffff" width="30px" viewBox="0 0 64 64"
                                            xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g data-name="37 rating" id="_37_rating">
                                                    <path
                                                        d="M42.83,3.5H21.17a6,6,0,0,0-6,6V28.66a6,6,0,0,0,6,6H23.4l7.84,9.23a1,1,0,0,0,1.1.29.992.992,0,0,0,.66-.94V34.66h9.83a6,6,0,0,0,6-6V9.5A6,6,0,0,0,42.83,3.5Zm4,25.16a4,4,0,0,1-4,4H32a1,1,0,0,0-1,1v6.86l-6.38-7.51a1.011,1.011,0,0,0-.76-.35H21.17a4,4,0,0,1-4-4V9.5a4,4,0,0,1,4-4H42.83a4,4,0,0,1,4,4Z">
                                                    </path>
                                                    <path
                                                        d="M44.66,10.75a1,1,0,0,1-1,1H20.34a1,1,0,0,1,0-2H43.66A1,1,0,0,1,44.66,10.75Z">
                                                    </path>
                                                    <path
                                                        d="M44.66,14.92a1,1,0,0,1-1,1H20.34a1,1,0,0,1,0-2H43.66A.99.99,0,0,1,44.66,14.92Z">
                                                    </path>
                                                    <path
                                                        d="M44.66,19.08a1,1,0,0,1-1,1H20.34a1,1,0,0,1,0-2H43.66A1,1,0,0,1,44.66,19.08Z">
                                                    </path>
                                                    <path
                                                        d="M44.66,23.25a1,1,0,0,1-1,1H28.67a1,1,0,0,1,0-2H43.66A.99.99,0,0,1,44.66,23.25Z">
                                                    </path>
                                                    <path
                                                        d="M44.66,27.41a1,1,0,0,1-1,1H28.67a1,1,0,0,1,0-2H43.66A1,1,0,0,1,44.66,27.41Z">
                                                    </path>
                                                    <path
                                                        d="M18.65,46.55a1.009,1.009,0,0,0-.95-.69H13.57l-1.28-3.93a1,1,0,0,0-1.9,0L9.11,45.86H4.98a1,1,0,0,0-.59,1.81L7.73,50.1,6.46,54.02a1,1,0,0,0,.95,1.31A1.01,1.01,0,0,0,8,55.14l3.34-2.43,3.34,2.43a1,1,0,0,0,1.54-1.11L14.94,50.1l3.35-2.43A1.012,1.012,0,0,0,18.65,46.55Zm-5.83,3.47.55,1.7-1.44-1.05a.99.99,0,0,0-1.18,0L9.31,51.72l.55-1.7a.992.992,0,0,0-.36-1.11L8.06,47.86H9.84a1.009,1.009,0,0,0,.95-.69l.55-1.7.55,1.7a1,1,0,0,0,.95.69h1.78l-1.44,1.05A.977.977,0,0,0,12.82,50.02Z">
                                                    </path>
                                                    <path
                                                        d="M39.31,51.71a1,1,0,0,0-.95-.69H34.23l-1.28-3.93a1,1,0,0,0-1.9,0l-1.28,3.93H25.64a1,1,0,0,0-.59,1.81l3.35,2.43-1.28,3.93a1.012,1.012,0,0,0,.36,1.12,1.022,1.022,0,0,0,1.18,0L32,57.88l3.34,2.43a1.011,1.011,0,0,0,1.18,0,1.012,1.012,0,0,0,.36-1.12L35.6,55.26l3.35-2.43A1,1,0,0,0,39.31,51.71Zm-5.83,3.48.55,1.69-1.44-1.05a1.011,1.011,0,0,0-1.18,0l-1.44,1.05.55-1.69a.992.992,0,0,0-.36-1.12l-1.44-1.05H30.5a1,1,0,0,0,.95-.69L32,50.64l.55,1.69a1,1,0,0,0,.95.69h1.78l-1.44,1.05A.992.992,0,0,0,33.48,55.19Z">
                                                    </path>
                                                    <path
                                                        d="M59.97,46.55a.991.991,0,0,0-.95-.69H54.89l-1.28-3.93a1,1,0,0,0-1.9,0l-1.28,3.93H46.3a1,1,0,0,0-.59,1.81l3.35,2.43-1.28,3.93a1,1,0,0,0,1.54,1.11l3.34-2.43L56,55.14a1.01,1.01,0,0,0,.59.19.967.967,0,0,0,.59-.19.987.987,0,0,0,.36-1.12L56.27,50.1l3.34-2.43A1,1,0,0,0,59.97,46.55Zm-5.83,3.47.55,1.7-1.44-1.05a.988.988,0,0,0-.59-.19,1.01,1.01,0,0,0-.59.19l-1.44,1.05.55-1.7a.977.977,0,0,0-.36-1.11l-1.44-1.05h1.78a1,1,0,0,0,.95-.69l.55-1.7.55,1.7a1.009,1.009,0,0,0,.95.69h1.78L54.5,48.91A.992.992,0,0,0,54.14,50.02Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\flexi\resources\views/dashboard/partials/top_stats.blade.php ENDPATH**/ ?>