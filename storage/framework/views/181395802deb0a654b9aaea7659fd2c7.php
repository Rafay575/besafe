<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard.view')): ?>

  <?php $__env->startSection('breadcrumb'); ?>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm">
      <a class="text-white" href="javascript:;">
      <i class="ni ni-box-2"></i>
      </a>
    </li>
    <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white"
      href="javascript:;">Dashoard</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Dashboard</h6>
  </nav>
  <?php $__env->stopSection(); ?>
  <?php $__env->startSection('content'); ?>
  <?php echo $__env->make('dashboard.partials.top_stats', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if($userType === 'employee'): ?>
    <?php echo $__env->make('dashboard.partials.employee', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
  <?php else: ?>
  <?php echo $__env->make('dashboard.partials.line_graph', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('dashboard.partials.recent_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.partials.dounut_graph', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('dashboard.partials.bottom_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>





  <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('script'); ?>

<script src="<?php echo e(asset('assets/js/chart.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/dashboard/index.blade.php ENDPATH**/ ?>