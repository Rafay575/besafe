<?php $__env->startSection('breadcrumb'); ?>
<?php if (isset($component)) { $__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e = $component; } ?>
<?php $component = App\View\Components\Templates\BreadCrumb::resolve(['pageTitle' => 'Roles List'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('templates.bread-crumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Templates\BreadCrumb::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e)): ?>
<?php $component = $__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e; ?>
<?php unset($__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginald6b053c3f0a17a40778ef03aa609c293 = $component; } ?>
<?php $component = App\View\Components\Templates\BasicPageTemp::resolve(['pageTitle' => 'Roles List','pageDesc' => 'List of Roles'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('templates.basic-page-temp'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Templates\BasicPageTemp::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
       <?php $__env->slot('pageHeader', null, []); ?> 
        <div class="ms-auto my-auto mt-lg-0 mt-4"> 
          <div class="ms-auto my-auto">
            <a href="<?php echo e(route('roles.create')); ?>" class="btn bg-purple btn-sm mb-0" >+&nbsp; New Role</a>
          </div>
        </div>
       <?php $__env->endSlot(); ?>
      

      
        <div class="table-responsive">
            <table class="table table-flush table-striped" id="roles-table" data-source="<?php echo e(route('roles.index')); ?>">
              <thead class="thead-light">
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.tblhead','data' => ['heads' => 'S.No,Role Name,Action']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.tblhead'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['heads' => 'S.No,Role Name,Action']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
              </thead>
              <tbody>
              </tbody>
             
            </table>
        </div>
      

    <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald6b053c3f0a17a40778ef03aa609c293)): ?>
<?php $component = $__componentOriginald6b053c3f0a17a40778ef03aa609c293; ?>
<?php unset($__componentOriginald6b053c3f0a17a40778ef03aa609c293); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>    
$(document).ready(function() {
  const table = $('#roles-table');
  const DataSource = table.attr('data-source');
  table.DataTable({
    ajax: {
      url: DataSource,
      type: 'GET',
    },
    

    columns: [
      { data: 'sno', name: 'sno' },
      { data: 'name', name: 'name' },
      { data: 'action', name: 'action', orderable: false, searchable: false },
    ],
    
  });
  
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/roles/index.blade.php ENDPATH**/ ?>