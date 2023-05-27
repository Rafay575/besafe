<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/jquery-validate.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/choices.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/core/spin.min.js')}}"></script>
<script src="{{asset('assets/js/core/ladda.min.js')}}"></script>
<script src="{{asset('assets/js/sweet_alerts.js')}}"></script>
<script src="{{asset('assets/js/plugins/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/validation.js?v8')}}"></script>

<!-- Kanban scripts -->
{{-- <script src="{{asset('assets/js/plugins/dragula/dragula.min.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/plugins/jkanban/jkanban.js')}}"></script> --}}
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    // choices multiple and single select code
    if (document.querySelectorAll("[id='choices-button']")) {
        var element = document.querySelectorAll("[id='choices-button']");
        for(var i = 0; i < element.length; i++){
          new Choices(element[i], {});
        } 
        // elms[i].style.display='none'; // <-- whatever you need to do here.
      }
    //  choices end here
      // jquery validation
  </script>
  <!-- Github buttons -->
  {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.5')}}"></script>
  <script src="{{asset('assets/js/plugins/datatables.js')}}"></script>
  <script src="{{asset('assets/js/datatable/datatables.min.js')}}"></script>
  <script src="{{asset('assets/js/datatable.js')}}"></script>

  