<?php $__env->startSection('breadcrumb'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Edit Business Hours</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Edit Business Hours</h6>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-12 mx-auto">
      <form action="<?php echo e(route('businesshours.update',$businesshours->id)); ?>" method="post" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="_method" value="put">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">

                <div class="form-group col-md-4">
                    <label for="businessName" class="form-label">Name *</label>
                    <input type="text" class="form-control" value="<?php echo e($businesshours->name); ?>" name="name" id="businessName" placeholder="e.g. Chicago Business Hours" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" value="<?php echo e($businesshours->description); ?>" name="description" id="description" placeholder="e.g. This Business Calendar belongs to Chicago timezone">
                </div>

                <div class="form-group col-md-4">
                    <label for="timeZone" class="form-label">Time zone *</label>
                    <select class="form-select" name="timezone" id="timeZone" required>
                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php echo e($businesshours->timezone == $timezone ? "selected" : ""); ?> value="<?php echo e($timezone); ?>"><?php echo e($timezone); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Business Hours Section -->
                <div class="form-group col-md-6">
                    <h5>Set business hours</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="businesshourstype" id="24x7" value="24x7" <?php echo e($businesshours->businesshourstype == "24x7" ? "checked" : ""); ?> >
                        <label class="form-check-label" for="24x7">
                            24 hrs x 7 days <small class="text-muted">Round the clock support</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="businesshourstype" id="customBusinessHours" value="custom" <?php echo e($businesshours->businesshourstype == "custom" ? "checked" : ""); ?>>
                        <label class="form-check-label" for="customBusinessHours">
                            Custom business hours <small class="text-muted">Setup custom working hours for your team</small>
                        </label>
                    </div>
                </div>

                <!-- Custom Business Hours Setup -->
                <div class="day-selector form-group col-md-6 <?php echo e($businesshours->businesshourstype == "24x7" ? "d-none" : ""); ?> " id="day-selector">
                    <h6>Select the working days</h6>
                    <div class="btn-group" role="group" aria-label="Day selector">

                        <input type="hidden" name="sunday" value="off" autocomplete="off">
                        <input type="checkbox" name="sunday" class="btn-check weekdays" id="sunday" <?php echo e($businesshours->sunday == "on" ? "checked" : ""); ?> autocomplete="off">
                        <label class="btn btn-outline-primary" for="sunday">Sun</label><br>

                        <input type="hidden" name="monday" value="off" autocomplete="off">
                        <input type="checkbox" name="monday" class="btn-check weekdays" id="monday" <?php echo e($businesshours->monday == "on" ? "checked" : ""); ?> autocomplete="off">
                        <label class="btn btn-outline-primary" for="monday">Mon</label><br>

                        <input type="hidden" name="tuesday" value="off" autocomplete="off">
                        <input type="checkbox" name="tuesday" class="btn-check weekdays" id="tuesday" <?php echo e($businesshours->tuesday == "on" ? "checked" : ""); ?> autocomplete="off">
                        <label class="btn btn-outline-primary" for="tuesday">Tue</label><br>

                        <input type="hidden" name="wednesday" value="off" autocomplete="off">
                        <input type="checkbox" name="wednesday" class="btn-check weekdays" id="wednesday" <?php echo e($businesshours->wednesday == "on" ? "checked" : ""); ?> autocomplete="off">
                        <label class="btn btn-outline-primary" for="wednesday">Wed</label><br>

                        <input type="hidden" name="thursday" value="off" autocomplete="off">
                        <input type="checkbox" name="thursday" class="btn-check weekdays" id="thursday" <?php echo e($businesshours->thursday == "on" ? "checked" : ""); ?> autocomplete="off">
                        <label class="btn btn-outline-primary" for="thursday">Thu</label><br>

                        <input type="hidden" name="friday" value="off" autocomplete="off">
                        <input type="checkbox" name="friday" class="btn-check weekdays" id="friday" <?php echo e($businesshours->friday == "on" ? "checked" : ""); ?> autocomplete="off">
                        <label class="btn btn-outline-primary" for="friday">Fri</label><br>

                        <input type="hidden" name="saturday" value="off" autocomplete="off">
                        <input type="checkbox" name="saturday" class="btn-check weekdays" id="saturday" <?php echo e($businesshours->saturday == "on" ? "checked" : ""); ?> autocomplete="off">
                        <label class="btn btn-outline-primary" for="saturday">Sat</label><br>

                    </div>
                    <small class="text-muted">(<span id="checked-count">0</span> days selected)</small>
                </div>

                <!-- Working Hours for each day -->
                <div id="working-hours-day" class="<?php echo e($businesshours->businesshourstype == "24x7" ? "d-none" : ""); ?> ">
                  <div class="row g-3 align-items-center mb-3">
                      <div class="col-md-3">
                          <label class="form-label">Monday</label>
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="monday_start" class="form-control" value="<?php echo e($businesshours->monday_start); ?>">
                      </div>
                      <div class="col-md-1 text-center">
                          to
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="monday_end" class="form-control" value="<?php echo e($businesshours->monday_end); ?>">
                      </div>
                      <div class="col-md-2">
                          <span class="copy-to-all" style="cursor: pointer;">Copy to all</span>
                      </div>
                  </div>

                  <!-- Repeat for other days -->
                  <div class="row g-3 align-items-center mb-3">
                      <div class="col-md-3">
                          <label class="form-label">Tuesday</label>
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="tuesday_start" class="form-control day_start_time" value="<?php echo e($businesshours->tuesday_start); ?>">
                      </div>
                      <div class="col-md-1 text-center">
                          to
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="tuesday_end" class="form-control day_end_time" value="<?php echo e($businesshours->tuesday_end); ?>">
                      </div>
                  </div>

                  <div class="row g-3 align-items-center mb-3">
                      <div class="col-md-3">
                          <label class="form-label">Wednesday</label>
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="wednesday_start" class="form-control day_start_time" value="<?php echo e($businesshours->wednesday_start); ?>">
                      </div>
                      <div class="col-md-1 text-center">
                          to
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="wednesday_end" class="form-control day_end_time" value="<?php echo e($businesshours->wednesday_end); ?>">
                      </div>
                  </div>

                  <div class="row g-3 align-items-center mb-3">
                      <div class="col-md-3">
                          <label class="form-label">Thursday</label>
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="thursday_start" class="form-control day_start_time" value="<?php echo e($businesshours->thursday_start); ?>">
                      </div>
                      <div class="col-md-1 text-center">
                          to
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="thursday_end" class="form-control day_end_time" value="<?php echo e($businesshours->thursday_end); ?>">
                      </div>
                  </div>

                  <div class="row g-3 align-items-center mb-3">
                      <div class="col-md-3">
                          <label class="form-label">Friday</label>
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="friday_start" class="form-control day_start_time" value="<?php echo e($businesshours->friday_start); ?>">
                      </div>
                      <div class="col-md-1 text-center">
                          to
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="friday_end" class="form-control day_end_time" value="<?php echo e($businesshours->friday_end); ?>">
                      </div>
                  </div>
                

                  <div class="row g-3 align-items-center mb-3">
                      <div class="col-md-3">
                          <label class="form-label">Saturday</label>
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="saturday_start" class="form-control day_start_time" value="<?php echo e($businesshours->saturday_start); ?>">
                      </div>
                      <div class="col-md-1 text-center">
                          to
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="saturday_end" class="form-control day_end_time" value="<?php echo e($businesshours->saturday_end); ?>">
                      </div>
                  </div>

                  <div class="row g-3 align-items-center mb-3">
                      <div class="col-md-3">
                          <label class="form-label">Sunday</label>
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="sunday_start" class="form-control day_start_time" value="<?php echo e($businesshours->sunday_start); ?>">
                      </div>
                      <div class="col-md-1 text-center">
                          to
                      </div>
                      <div class="col-md-3">
                          <input type="time" name="sunday_end" class="form-control day_end_time" value="<?php echo e($businesshours->sunday_end); ?>">
                      </div>
                  </div>
                </div>
              </div>

              <!-- Save and Cancel Buttons -->
              <div class="d-flex justify-content-start mt-4">
                  <button type="submit" class="btn btn-primary me-2">Save</button>
              </div>




            </div>
          </div>
        </div>
      </div>





      </form>
  </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?> 

  <script>
    $('.copy-to-all').click(function(){
      var start_time = document.querySelectorAll('input[name=monday_start]')[0].value;
      var end_time   = document.querySelectorAll('input[name=monday_end]')[0].value;

      document.querySelectorAll('input.day_start_time').forEach(function(input) {
          input.value = start_time;
      });

      document.querySelectorAll('input.day_end_time').forEach(function(input) {
          input.value = end_time;
      });

    });

  </script>

  <script>
    $('#24x7').click(function(){
      var element = document.getElementById("day-selector").classList.add("d-none");
      var element = document.getElementById("working-hours-day").classList.add("d-none");
    });

    $('#customBusinessHours').click(function(){
      var element = document.getElementById("day-selector").classList.remove("d-none");
      var element = document.getElementById("working-hours-day").classList.remove("d-none");
    });
  </script>

  <script>
      const checkboxes = document.querySelectorAll('.weekdays');
      const countDisplay = document.getElementById('checked-count');

      checkboxes.forEach(checkbox => {
          checkbox.addEventListener('click', () => {
              const checkedCount = document.querySelectorAll('.weekdays:checked').length;
              countDisplay.textContent = checkedCount;
          });
      });
  </script>

  <script type="text/javascript">
    $( document ).ready(function() {
      const checkboxes = document.querySelectorAll('.weekdays');
      const countDisplay = document.getElementById('checked-count');

      checkboxes.forEach(checkbox => {
        const checkedCount = document.querySelectorAll('.weekdays:checked').length;
        countDisplay.textContent = checkedCount;
      });
    });
  </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/businesshours/edit.blade.php ENDPATH**/ ?>