
    <td class="text-sm">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role.edit')): ?>
        <?php if (isset($component)) { $__componentOriginal75f83a4411958f313bf077bc1c9be8ed = $component; } ?>
<?php $component = App\View\Components\Forms\ActionBtn::resolve(['href' => ''.e(route('roles.show',$role['id'])).'','action' => 'edit','title' => 'edit role'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.action-btn'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ActionBtn::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal75f83a4411958f313bf077bc1c9be8ed)): ?>
<?php $component = $__componentOriginal75f83a4411958f313bf077bc1c9be8ed; ?>
<?php unset($__componentOriginal75f83a4411958f313bf077bc1c9be8ed); ?>
<?php endif; ?>
        <?php endif; ?>

        
        
    </td>
<?php /**PATH C:\wamp64\www\flexi\resources\views/roles/partials/action-buttons.blade.php ENDPATH**/ ?>