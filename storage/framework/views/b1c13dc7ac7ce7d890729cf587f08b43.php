    <?php
        $ths = explode(",",$heads);
    ?>
<tr>
    <?php $__currentLoopData = $ths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $th): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <th <?php echo e($attributes); ?>><?php echo e($th); ?></th>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tr><?php /**PATH C:\wamp64\www\flexi\resources\views/components/table/tblhead.blade.php ENDPATH**/ ?>