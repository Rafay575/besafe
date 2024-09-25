<div class="form-group <?php echo e($width); ?>">
  <?php if($label != ""): ?>
    <label for="<?php echo e($name); ?>" class="form-control-label"><?php echo e($label); ?></label>
  <?php endif; ?>
    <input type="<?php echo e($type); ?>" class="form-control <?php echo e($inputClass); ?>" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" placeholder="<?php echo e($label); ?>" value="<?php echo e($value); ?>" <?php echo e($attributes); ?> <?php if(isset($required) && $required): ?> required <?php endif; ?> >
  </div><?php /**PATH C:\wamp64\www\flexi\resources\views/components/forms/basic-input.blade.php ENDPATH**/ ?>