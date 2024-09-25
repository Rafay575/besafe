<?php $__env->startSection('breadcrumb'); ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <li class="breadcrumb-item text-sm">
        <a class="text-white" href="javascript:;">
          <i class="ni ni-box-2"></i>
        </a>
      </li>
      <li class="breadcrumb-item text-sm text-white active"><a class="opacity-5 text-white" href="javascript:;">Tickets List</a></li>
    </ol>
    <h6 class="font-weight-bolder mb-0 text-white">Tickets List</h6>
  </nav>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
      <div class="card bg-white-custom lightborder-unique shadow-lg">

        <div class="card-header bg-white-custom  pb-0">
            <div class="d-lg-flex">
              <div>
                <h5 class="mb-0">Tickets</h5>
                <p class="text-sm mb-0">
                 List of Tickets
                </p>
              </div>
              <div class="ms-auto my-auto mt-lg-0 mt-4">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('adminsetting.create')): ?>    
                  <div class="ms-auto my-auto">
                    <a href="<?php echo e(route('tickets.create')); ?>" class="btn bg-gradient-primary btn-sm mb-0" >+&nbsp; Add New</a>
                  </div>
                <?php endif; ?>
              </div>
            </div>
        </div>

        <div class="table-responsive"style="border-collapse: collapse; border-spacing: 0; width: 95%; margin-left: 2%;">
          <table class="table table-flush dataTable no-footer table-striped" id="tickets-table">
            <thead class="thead-light">
              <tr>
                <th>Ticket Type</th>
                <th>Total Comments</th>
                <th>Requested By</th>
                <th>Assign To</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($ticket->tickettype->name); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($ticket->comments->count()); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($ticket->requestedby->name); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($ticket->assignto->name); ?>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                      <?php echo e($ticket->status); ?>

                    </div>
                </td>
           
                <td>
                   <div style="width: 60%;">

                    <a 
                        href="<?php echo e(route('ticket.view', ['id' => $ticket->id])); ?>" 
                        class="mx-2" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="view ticket" 
                        data-container="body" 
                        data-animation="true" 
                        data-bs-original-title="view ticket"
                      >
                      <i class="fas fa-eye text-primary"></i>
                    </a>
                     
                    <?php if($ticket->status == "Open"): ?>
                    <a 
                        href="<?php echo e(route('tickets.edit', $ticket->id)); ?>" 
                        class="mx-2" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="edit ticket" 
                        data-container="body" 
                        data-animation="true" 
                        data-bs-original-title="edit ticket"
                      >
                      <i class="fas fa-user-edit text-purple"></i>
                    </a>
                    <?php endif; ?>

                    <?php if($ticket->status == "Closed" && $ticket->requested_by == auth()->user()->id): ?>
                    <a 
                        href="<?php echo e(route('ticket.feedback', $ticket->id)); ?>" 
                        class="mx-2" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="Feedback" 
                        data-container="body" 
                        data-animation="true" 
                        data-bs-original-title="Feedback"
                      >
                      <i class="fas fa-star text-primary"></i>
                    </a>
                    <?php endif; ?>

                    
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
        new DataTable('#tickets-table');
    });


 </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/tickets/index.blade.php ENDPATH**/ ?>