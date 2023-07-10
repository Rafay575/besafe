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
<script src="{{asset('assets/js/sweet_alerts.js?v2')}}"></script>
<script src="{{asset('assets/js/plugins/dropzone.min.js')}}"></script>
<script src="{{asset('assets/js/validation.js?v9')}}"></script>

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
  <script src="{{asset('assets/js/plugins/moment.min.js')}}"></script>
  <script src="{{asset('assets/js/datatable/datatables.min.js')}}"></script>
  <script src="{{asset('assets/js/datatable.js?v1')}}"></script>


 
  
{{-- Below code is for notifications  --}}
{{-- modals --}}
<x-modals.basic-modal title="Show Notification" id="notificationShow" footer="no" header="yes" class="modal fade modal-md">
  <div class="notification_detail_body">

  </div>
</x-modals.basic-modal>
<!-- Modal -->
  <script>
    function fetchNotification(){
      $.ajax({
      url: "{{ route('notifications.index') }}",
      type: "GET",
      success: function(response) {
        // Iterate over each notification
        response.forEach(function(notification) {
          let timestamp = moment(notification.created_at).fromNow(); // Format the timestamp using a library like Moment.js
          let html = '<li class="mb-2">' +
                      '<a class="dropdown-item border-radius-md"  data-bs-toggle="modal" data-notification_id="'+notification.id+'" data-notification_url="'+notification.url+'" data-notification_description="'+notification.description+'" data-notification_details="'+notification.affects+'" id="notification_toggle_view"  data-bs-target="#notificationShow" >' +
                      '<div class="d-flex py-1">' +
                      '<div class="my-auto">' +
                      '<img src="'+notification.causer_image+'" class="avatar avatar-sm  me-3 " alt="user image">' +
                      '</div>' +
                      '<div class="d-flex flex-column justify-content-center">' +
                      '<h6 class="text-sm font-weight-normal mb-1">' +
                      '<span class="font-weight-bold text-dark">' + notification.description + '</span>' +
                      '</h6>' +
                      '<p class="text-xs text-secondary mb-0">' +
                      '<i class="fa fa-clock me-1"></i>' + timestamp +
                      '</p>' +
                      '</div>' +
                      '</div>' +
                      '</a>' +
                      '</li>';

         
          $('ul.notifications').append(html);
        });
        let notificationCount = response.length; // Get the count of notifications
        $('#notification-badge').text(notificationCount);
      },
      error: function(xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });
    }

    fetchNotification();

    $('body').on('click','a#notification_toggle_view',function(e){
      let notificationDetaisl = "<strong>" +$(this).attr('data-notification_description') + "</strong><br><br>";
      let notificationId = $(this).attr('data-notification_id');
       updateNotificationSeen(notificationId);
       notificationDetaisl += $(this).attr('data-notification_details');
       notificationDetaisl += '<br><a  class ="btn btn-sm btn-primary mt-2" href="'+$(this).attr('data-notification_url')+'">View</a>';
      $('div.notification_detail_body').empty().html(notificationDetaisl);
      fetchNotification()
    });
    $('body').on('hover','a#notification_toggle_view',function(e){
      let notificationId = $(this).attr('data-notification_id');
      alert('test');
    });

  function updateNotificationSeen(notification_id){
    var token = $("meta[name='csrf-token']").attr("content");
      $.ajax({
        url: "{{ route('notifications.activitySeen')}}",
        type: "POST",
        dataType: "json",
        data: {
          notification_id,
          _token: token
        },
        success: function(response) {
          // Handle the success response
          console.log(response);
        },
        error: function(xhr, status, error) {
          // Handle the error response
          console.error(error);
        }
      });
    }
  </script>