<?php $__env->startSection('breadcrumb'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Update SLA Policy</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Update SLA Policy</h6>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-12 mx-auto">
      <form action="<?php echo e(route('slapolicies.update',$slapolicy->id)); ?>" method="post" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <input type="hidden" name="_method" value="put">

      <div class="row">
        <div class="col-12">
          <div class="card bg-white-custom lightborder-unique shadow-lg">
            <div class="card-body">
              
              <div class="row">

                <div class="form-group col-md-4">
                    <label for="businessName" class="form-label">Name *</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo e($slapolicy->name); ?>" placeholder="e.g. Chicago Business Hours" required>
                </div>

                <div class="form-group col-md-8">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" value="<?php echo e($slapolicy->description); ?>" id="description" placeholder="e.g. This Business Calendar belongs to Chicago timezone">
                </div>

                <!-- SLA Target Section -->
                <h5 class="mt-4">Set SLA target as:</h5>
                <div class="table-responsive">
                    <table class="table align-middle table-striped">
                        <thead>
                            <tr>
                                <th>Priority</th>
                                <th>First response time</th>
                                <th>Resolution time</th>
                                <th>Operational hours</th>
                                <th>Escalation</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                              if($priority->priority == "Urgent"){
                                $badge_class = "bg-danger";
                              } elseif($priority->priority == "High"){
                                $badge_class = "bg-warning";
                              } elseif($priority->priority == "Medium"){
                                $badge_class = "bg-info";
                              } elseif($priority->priority == "Low"){
                                $badge_class = "bg-success";
                              } else {
                                $badge_class = "";
                              }

                            ?>
                            <tr>
                                <td><span class="badge <?php echo e($badge_class); ?>"><?php echo e($priority->priority); ?></span></td>
                                <td><input type="text" name="<?php echo e(strtolower($priority->priority)); ?>_first_response_time" value="<?php echo e($slapolicy->{strtolower($priority->priority)."_first_response_time"}); ?>" class="form-control" placeholder="10m"></td>
                                <td><input type="text" name="<?php echo e(strtolower($priority->priority)); ?>_resolution_time" value="<?php echo e($slapolicy->{strtolower($priority->priority)."_resolution_time"}); ?>" class="form-control" placeholder="10m"></td>
                                <td>
                                    <select name="<?php echo e(strtolower($priority->priority)); ?>_operational_hours" class="form-select">
                                        <option value="business_hours" selected>Business hours</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input name="<?php echo e(strtolower($priority->priority)); ?>_escalation" value="off" type="hidden">
                                        <input name="<?php echo e(strtolower($priority->priority)); ?>_escalation" class="form-check-input" type="checkbox" <?php echo e($slapolicy->{strtolower($priority->priority)."_escalation"} == "on" ? "checked" : ""); ?>>
                                    </div>
                                </td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                  <div class="mt-4 d-flex">
                      <button type="submit" class="btn btn-primary me-2">Update</button>
                  </div>
                </div>
              </div>

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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/slapolicy/edit.blade.php ENDPATH**/ ?>