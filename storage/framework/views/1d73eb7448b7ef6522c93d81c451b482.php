<?php $__env->startSection('breadcrumb'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Create Tickets</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Create New Tickets</h6>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-12 mx-auto">
    <form action="<?php echo e(route('tickets.store')); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">

                  <div class="form-group col-md-4 <?php $__errorArgs = ['tickettype_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <label for="tickettype_id" class="form-control-label">Ticket Type</label>
                  <select class="form-control" name="tickettype_id" id="tickettype_id" >
                      <?php $__currentLoopData = $tickettypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tickettype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tickettype->id); ?>"><?php echo e($tickettype->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>

                  <div class="form-group col-md-4 <?php $__errorArgs = ['ticketsubtype_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <label for="ticketsubtype_id" class="form-control-label">Ticket Sub Type</label>
                  <select class="form-control" name="ticketsubtype_id" id="ticketsubtype_id" >
                      <?php $__currentLoopData = $ticketsubtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticketsubtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ticketsubtype->id); ?>"><?php echo e($ticketsubtype->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>

                  <div class="form-group col-md-4 <?php $__errorArgs = ['ticket_attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <label for="ticket_attachment">Attachment</label>
                    <input type="file" name="ticket_attachment" class="form-control" id="ticket_attachment">
                    <?php $__errorArgs = ['ticket_attachment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="name">Description</label>
                    <textarea  name="description" class="form-control" id="description"></textarea>
                  </div>


                  <div class="form-group col-md-4">
                      <button type="submit" class="btn btn-primary w-50 mt-4 ">Create Ticket</button>
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

    <script type="text/javascript">
        document.getElementById("mobile").addEventListener("input", function() {
            var inputValue = this.value;
            console.log(inputValue);
            if (inputValue === "" || inputValue < 923) {
                this.value = "923";
            }
            if (inputValue.length > 12) {
                this.value = inputValue.slice(0, 12);
            }
        });
    </script>

<!--   <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script> -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/tickets/create.blade.php ENDPATH**/ ?>