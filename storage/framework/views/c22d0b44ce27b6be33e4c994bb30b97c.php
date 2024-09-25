<div class=" my-2">
    <div class="row">
        <!-- Helpdesk Insights -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card ticket-card shadow-lg lightborder-unique">
                <div class="px-4 py-2">
                    <div class="d-flex align-items-center">
                        <div class="icon-placeholder">
                            <img src="<?php echo e(asset('assets/img/ticket_employee_svg.svg')); ?>" alt="icons"
                                style="width:100%;height:100%;">

                        </div>
                        <div>
                            <h3 class="mb-0 text-black" style="font-weight:20px"><?php echo e($total_tickets); ?></h3>

                            <p class="text text-black" style="margin:0;font-weight:16px">Total Helpdesk Tickets</p>
                        </div>
                    </div>
                    <div class="mt-4 tickets-status-parent">
                        <p class="ticket-status "><span class="ticket-status-tab ticket-status-urgent">Urgent</span>
                            <span class="float-end " style="color:#000"><?php echo e($priorityData['Urgent']); ?></span>
                        </p>
                        <p class="ticket-status "> <span class="ticket-status-tab ticket-status-repeated"> High</span>
                            <span class="float-end " style="color:#000"><?php echo e($priorityData['High']); ?></span>
                        </p>
                        <p class="ticket-status "> <span class="ticket-status-tab ticket-status-new"> Medium</span>
                            <span class="float-end " style="color:#000"><?php echo e($priorityData['Medium']); ?></span>
                        </p>
                        <p class="ticket-status "> <span class="ticket-status-tab ticket-status-closed"> Low</span>
                            <span class="float-end " style="color:#000"><?php echo e($priorityData['Low']); ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Tickets -->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card ticket-card shadow-lg lightborder-unique">
                <div class="py-2 px-4">
                    <p style="font-size:20px;color:#000;font-weight:600">My Tickets</p>

                    <div class="list-group-unique mt-3">
                        <?php if($tickets->isEmpty()): ?>
                            <!-- No tickets message -->
                            <div class="d-flex justify-content-center mt-5">
                                <p class="heading">No data found</p>
                            </div>
                        <?php else: ?>
                            <!-- Dynamically render each ticket -->
                            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('ticket.feedback', $ticket->id)); ?>" class="text-decoration-none ">
                                    <div class="mt-3 <?php echo e(in_array($loop->index, [0, 2, 4]) ? 'bg-changed-unique' : ''); ?> ticket-card-1"
                                        style="cursor: pointer;">
                                        <p class="heading"><?php echo e($ticket->description); ?></p>
                                        <p class="text mb-0"><?php echo e($ticket->created_at); ?></p>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <!-- Pagination links -->
                        <?php endif; ?>
                    </div>

                </div>
                <div class="px-4 mb-2 position-absolute d-flex justify-content-between  align-items-center bottom-0" style="width:95%">

                    <div class="">
                        Showing <?php echo e($tickets->firstItem()); ?> to <?php echo e($tickets->lastItem()); ?> of <?php echo e($tickets->total()); ?>

                        results
                    </div>
                    <div class="">
                        <?php if($tickets->lastPage() > 1): ?>
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <?php for($page = 1; $page <= $tickets->lastPage(); $page++): ?>
                                        <li class="page-item ">
                                            <a class="page-link <?php echo e($page == $tickets->currentPage() ? 'active-unique' : ''); ?>"
                                                href="<?php echo e($tickets->url($page)); ?>"><?php echo e($page); ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        <?php endif; ?>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div><?php /**PATH C:\wamp64\www\flexi\resources\views/dashboard/partials/employee.blade.php ENDPATH**/ ?>