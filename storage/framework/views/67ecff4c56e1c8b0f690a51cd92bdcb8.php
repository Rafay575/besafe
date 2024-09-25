<?php $__env->startSection('breadcrumb'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Employees List</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Employees List</h6>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
      <div class="card bg-white-custom lightborder-unique shadow-lg">

        <div class="card-header bg-white-custom pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Employees</h5>
                <p class="text-sm mb-0">
                 List of Employees
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                  <a href="<?php echo e(route('employees.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Add New</a>
                </div>
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unsafe_behavior.create')): ?>     -->
                <!-- <?php endif; ?> -->
              </div>
            </div>
        </div>

        <div class="table-responsive"style="border-collapse: collapse; border-spacing: 0; width: 95%; margin-left: 2%;">
          <table class="table table-flush dataTable no-footer table-striped" id="employees-table">
            <thead class="thead-light">
              <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($employee->employee_id); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($employee->name); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($employee->email); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($employee->user->roles->pluck('name')->first()); ?>

                    </div>
                </td>                                
                <td>
                   <div style="width: 40%;">
                     
                    <a 
                        href="<?php echo e(route('employees.edit', $employee->id)); ?>" 
                        class="mx-2" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="edit employee" 
                        data-container="body" 
                        data-animation="true" 
                        data-bs-original-title="edit employee"
                      >
                      <i class="fas fa-user-edit text-purple"></i>
                    </a>

                    <form action="<?php echo e(route('employees.destroy', $employee->id)); ?>" method="post" style="float:right;">
                      <input type="hidden" name="_method" value="DELETE">
                      <?php echo csrf_field(); ?>
                         <button id="btnDelete" onclick="return confirm('Are you sure?')"  class="btn shadow-none" style="padding: 0px 0px;"><i class="fas fa-trash text-danger"></i></button>
                             
                    </form>
                   </div> 
                </td>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>

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
        new DataTable('#users-table');
    });


 </script>

<?php $__env->stopSection(); ?>


<!-- admin Muhammad Yousaf 03027794612
DELETE FROM users WHERE id != 4, 21,30;
-->
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/employees/index.blade.php ENDPATH**/ ?>