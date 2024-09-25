<?php $__env->startSection('breadcrumb'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Users List</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Users List</h6>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
      <div class="card bg-white-custom lightborder-unique shadow-lg">

        <div class="card-header bg-white-custom pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Users</h5>
                <p class="text-sm mb-0">
                 List of Users
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <div class="ms-auto my-auto">
                  <a href="<?php echo e(route('users.create')); ?>" class="btn bg-purple btn-sm mb-0" >+&nbsp; Add New</a>
                </div>
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unsafe_behavior.create')): ?>     -->
                <!-- <?php endif; ?> -->
              </div>
            </div>
        </div>

        <div class="table-responsive"style="border-collapse: collapse; border-spacing: 0; width: 95%; margin-left: 2%;">
          <table class="table table-flush dataTable no-footer table-striped" id="users-table">
            <thead class="thead-light">
              <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($user->user_id); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($user->name); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($user->email); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($user->roles->pluck('name')->first()); ?>

                    </div>
                </td>                                
                <td>
                   <div style="width: 40%;">
                     
                    <a 
                        href="<?php echo e(route('users.edit', $user->id)); ?>" 
                        class="mx-2" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="edit User" 
                        data-container="body" 
                        data-animation="true" 
                        data-bs-original-title="edit user"
                      >
                      <i class="fas fa-user-edit text-purple"></i>
                    </a>

                    <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="post" style="float:right;">
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/users/index.blade.php ENDPATH**/ ?>