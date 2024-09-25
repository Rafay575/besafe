<?php $__env->startSection('breadcrumb'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Business Hours</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Business Hours</h6>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
      <div class="card">

        <div class="card-header pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Business Hours</h5>
                <p class="text-sm mb-0">
                 Business Hours
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('adminsetting.create')): ?>    
                  <?php if(isset($businesshours->id)): ?>
                    <div class="ms-auto my-auto">
                      <a href="<?php echo e(route('businesshours.edit', $businesshours->id)); ?>" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Update business hours</a>
                    </div>
                  <?php else: ?>
                    <div class="ms-auto my-auto">
                      <a href="<?php echo e(route('businesshours.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Add business hours</a>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
        </div>

        <?php if(isset($businesshours->id)): ?>
        <div class="row">
          <div class="col-12 mb-4">
            <div class="container mt-5">
                <div class="card mt-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1"><?php echo e($businesshours->name); ?> <i class="bi bi-lock"></i></h5>
                            <p class="card-text text-muted mb-0"><?php echo e($businesshours->timezone); ?></p>
                        </div>
                        <!-- 
                        <div>
                            <button class="btn btn-link text-dark p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                <li><a class="dropdown-item" href="#">Delete</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
          </div>
        </div>
        <?php endif; ?>



    </div>
  </div>
</div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>

  <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap.css" rel="stylesheet" />

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap.js"></script>

<script>

    $( document ).ready(function() {
        new DataTable('#departments-table');
    });


 </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/businesshours/index.blade.php ENDPATH**/ ?>