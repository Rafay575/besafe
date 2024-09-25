<div class="p-4 mt-4 py-3 shadow-lg bg-white-custom moveAbove-unique lightborder-unique card">
    <h3 class="mb-4">Recent Tickets</h3>
    <div class="table-responsive">

        <table class="table table-striped table-hover ">
            <thead style="background-color:#0A3AA9;color:#fff;padding:0 20px">
                <tr class="bordered-row">
                    <th style="padding:10px ">#</th>
                    <th style="padding:10px ">Ticket Type</th>
                    <th style="padding:10px ">Requested By</th>
                    <th style="padding:10px ">Assign To</th>

                    <th style="padding:10px;text-align:justify ">Status</th>
                    <th style="padding:10px ">Priority</th>
                </tr>

            </thead>
            <tbody>
                <?php
                    // Dummy ticket data
                    $tickets = [
                        ['id' => 1, 'ticket_type' => 'Website Issue', 'status' => 'open', 'priority' => 'High','requested_by'=>'Rafay','assign_to'=>'Ahmed'],
                        [
                            'id' => 2,
                            'ticket_type' => 'Database Downtime',
                            'status' => 'In Progress',
                            'priority' => 'Urgent'
                            ,'requested_by'=>'Rafay','assign_to'=>'Ahmed'
                        ],
                        ['id' => 3, 'ticket_type' => 'Bug Report', 'status' => 'Closed', 'priority' => 'Medium','requested_by'=>'Rafay','assign_to'=>'Ahmed'],
                        ['id' => 4, 'ticket_type' => 'Feature Request', 'status' => 'feedback', 'priority' => 'Low','requested_by'=>'Rafay','assign_to'=>'Ahmed'],
                        ['id' => 5, 'ticket_type' => 'Email Issue', 'status' => 'open', 'priority' => 'High','requested_by'=>'Rafay','assign_to'=>'Ahmed'],
                        [
                            'id' => 6,
                            'ticket_type' => 'API Connectivity',
                            'status' => 'In Progress',
                            'priority' => 'Low','requested_by'=>'Rafay','assign_to'=>'Ahmed'
                        ],
                        ['id' => 7, 'ticket_type' => 'Server Migration', 'status' => 'Closed', 'priority' => 'Medium','requested_by'=>'Rafay','assign_to'=>'Ahmed'],
                        ['id' => 8, 'ticket_type' => 'Login Issue', 'status' => 'open', 'priority' => 'Urgent','requested_by'=>'Rafay','assign_to'=>'Ahmed'],
                        ['id' => 9, 'ticket_type' => 'Payment Gateway ', 'status' => 'feedback', 'priority' => 'Low','requested_by'=>'Rafay','assign_to'=>'Ahmed'],
                        ['id' => 10, 'ticket_type' => 'Password Reset', 'status' => 'open', 'priority' => 'High','requested_by'=>'Rafay','assign_to'=>'Ahmed'],
                    ];
                ?>

                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding:10px ; text-align:justify;"><?php echo e($ticket['id']); ?></td>
                        <td style="padding:10px ; text-align:justify;"><?php echo e($ticket['ticket_type']); ?></td>
                        <td style="padding:10px ; text-align:justify;"><?php echo e($ticket['requested_by']); ?></td>
                        <td style="padding:10px ; text-align:justify;"><?php echo e($ticket['assign_to']); ?></td>
                        <td style="padding:10px 20px;text-align:justify">
                            <?php if($ticket['status'] == 'open'): ?>
                                <span class="status-open padding-custom recent-status-btn-unique">Open</span>
                            <?php elseif($ticket['status'] == 'In Progress'): ?>
                                <span class="status-inprogress padding-custom recent-status-btn-unique">In
                                    Progress</span>
                            <?php elseif($ticket['status'] == 'feedback'): ?>
                                <span class="status-feedback padding-custom recent-status-btn-unique">Feedback</span>
                            <?php else: ?>
                                <span class="status-closed padding-custom recent-status-btn-unique">Closed</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding:10px ; text-align:justify;"><?php echo e($ticket['priority']); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>
<?php /**PATH C:\wamp64\www\flexi\resources\views/dashboard/partials/recent_table.blade.php ENDPATH**/ ?>