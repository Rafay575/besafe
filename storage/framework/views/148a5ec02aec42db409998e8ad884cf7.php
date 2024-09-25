
<a href="<?php echo e($href); ?>" class="mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($title); ?>" data-container="body" data-animation="true" data-bs-original-title="<?php echo e($title); ?>" >
    <?php if($action === 'view'): ?>
    
    <?php endif; ?>
    <?php switch($action):
        case ("view"): ?>
        <i class="fas fa-eye text-success" <?php echo e($attributes); ?>></i>
            <?php break; ?>
        <?php case ("assign"): ?>
        <i class="fas fa-check-double text-success" <?php echo e($attributes); ?>></i>
            <?php break; ?>
        <?php case ("edit"): ?>
      <i class="fas fa-user-edit text-purple" <?php echo e($attributes); ?>></i>
            <?php break; ?>
        <?php case ("delete"): ?>
          <i class="fas fa-trash text-danger" <?php echo e($attributes); ?>></i>
            <?php break; ?>
        <?php case ("download"): ?>
          <i class="fas fa-download text-success" <?php echo e($attributes); ?>></i>
            <?php break; ?>
        <?php default: ?>
        <i class="fas fa-eye text-secondary" <?php echo e($attributes); ?>></i>
    <?php endswitch; ?>
  </a><?php /**PATH C:\wamp64\www\flexi\resources\views/components/forms/action-btn.blade.php ENDPATH**/ ?>