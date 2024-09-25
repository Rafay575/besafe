<div <?php echo e($attributes); ?> id="<?php echo e($id); ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo e($id); ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <?php if($header === "yes"): ?>
        <div class="modal-header">
            <h5 class="font-weight-bolder text-primary text-gradient" id="<?php echo e($id); ?>Label"><?php echo e($title); ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php endif; ?>
        <div class="modal-body">
         <?php echo e($slot); ?>

        </div>
        
        <?php if($footer === "yes"): ?>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div><?php /**PATH C:\wamp64\www\flexi\resources\views/components/modals/basic-modal.blade.php ENDPATH**/ ?>