<?php $__env->startSection('breadcrumb'); ?>
<?php if (isset($component)) { $__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e = $component; } ?>
<?php $component = App\View\Components\Templates\BreadCrumb::resolve(['pageTitle' => 'View / Edit Role'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('templates.bread-crumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Templates\BreadCrumb::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="<?php echo e(route('roles.index')); ?>">Roles List</a></li>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e)): ?>
<?php $component = $__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e; ?>
<?php unset($__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php if (isset($component)) { $__componentOriginald6b053c3f0a17a40778ef03aa609c293 = $component; } ?>
<?php $component = App\View\Components\Templates\BasicPageTemp::resolve(['pageTitle' => 'View / Edit Role','pageDesc' => 'View / Edit Role'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('templates.basic-page-temp'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Templates\BasicPageTemp::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
       <?php $__env->slot('pageHeader', null, []); ?> 
        <div class="ms-auto my-auto mt-lg-0 mt-4 bg-white-custom ">
          <div class="ms-auto my-auto">
            
          </div>
        </div>
       <?php $__env->endSlot(); ?>
      

      
      <div class="card-body ">
        <form action="<?php echo e(route('roles.store')); ?>" method="post" class="ajax-form">
        <div class="d-flex mb-3  bg-secondary text-light p-2 rounded">
            <span class="mt-2 ml-2 text-sm" style="width:100px"><strong>Role Name</strong></span>
            <input required type="text" name="role_name" id="role_name" readonly class="form-control form-control-sm" value="<?php echo e($role->name); ?>">
        </div>
    <h5>Permission</h5>
        <?php echo csrf_field(); ?>
      <table class="table table-sm table-bordered table-striped">
        <tbody>
            <thead>
                <tr>
                    <th  class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">#</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Permission</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Index</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">View</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Create</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Edit</th>
                    <th class="text-uppercase text-secondary text-xs  font-weight-bolder opacity-7">Delete</th>
                </tr>
            </thead>
            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
           <?php if(!in_array('meta',$module)): ?>
               
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td class="d-flex"><span class="text-bold text-sm"><?php echo e($module['name']); ?></span> <a class="px-2 text-success text-sm" href="#" id="select_all">Select All</a></td>
                <td><span class="text-sm"><?php if (isset($component)) { $__componentOriginal011326ec41fbfadf01351df3028773ad = $component; } ?>
<?php $component = App\View\Components\Forms\ToggleCheck::resolve(['label' => '','name' => 'permissions[]','value' => ''.e($module['slug']).'.index','width' => 'col-6','checkBoxClass' => '','checked' => ''.e($permissions->contains($module['slug'].'.index') ? 'true' : 'false').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.toggle-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ToggleCheck::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($module['slug']).'.index']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal011326ec41fbfadf01351df3028773ad)): ?>
<?php $component = $__componentOriginal011326ec41fbfadf01351df3028773ad; ?>
<?php unset($__componentOriginal011326ec41fbfadf01351df3028773ad); ?>
<?php endif; ?></span></td>
                <td><span class="text-sm"><?php if (isset($component)) { $__componentOriginal011326ec41fbfadf01351df3028773ad = $component; } ?>
<?php $component = App\View\Components\Forms\ToggleCheck::resolve(['label' => '','name' => 'permissions[]','value' => ''.e($module['slug']).'.view','width' => 'col-6','checkBoxClass' => '','checked' => ''.e($permissions->contains($module['slug'].'.view') ? 'true' : 'false').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.toggle-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ToggleCheck::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($module['slug']).'.view']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal011326ec41fbfadf01351df3028773ad)): ?>
<?php $component = $__componentOriginal011326ec41fbfadf01351df3028773ad; ?>
<?php unset($__componentOriginal011326ec41fbfadf01351df3028773ad); ?>
<?php endif; ?></span></td>
                <td><span class="text-sm"><?php if (isset($component)) { $__componentOriginal011326ec41fbfadf01351df3028773ad = $component; } ?>
<?php $component = App\View\Components\Forms\ToggleCheck::resolve(['label' => '','name' => 'permissions[]','value' => ''.e($module['slug']).'.create','width' => 'col-6','checkBoxClass' => '','checked' => ''.e($permissions->contains($module['slug'].'.create') ? 'true' : 'false').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.toggle-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ToggleCheck::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($module['slug']).'.create']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal011326ec41fbfadf01351df3028773ad)): ?>
<?php $component = $__componentOriginal011326ec41fbfadf01351df3028773ad; ?>
<?php unset($__componentOriginal011326ec41fbfadf01351df3028773ad); ?>
<?php endif; ?></span></td>
                <td><span class="text-sm"><?php if (isset($component)) { $__componentOriginal011326ec41fbfadf01351df3028773ad = $component; } ?>
<?php $component = App\View\Components\Forms\ToggleCheck::resolve(['label' => '','name' => 'permissions[]','value' => ''.e($module['slug']).'.edit','width' => 'col-6','checkBoxClass' => '','checked' => ''.e($permissions->contains($module['slug'].'.edit') ? 'true' : 'false').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.toggle-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ToggleCheck::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($module['slug']).'.edit']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal011326ec41fbfadf01351df3028773ad)): ?>
<?php $component = $__componentOriginal011326ec41fbfadf01351df3028773ad; ?>
<?php unset($__componentOriginal011326ec41fbfadf01351df3028773ad); ?>
<?php endif; ?></span></td>
                <td><span class="text-sm"><?php if (isset($component)) { $__componentOriginal011326ec41fbfadf01351df3028773ad = $component; } ?>
<?php $component = App\View\Components\Forms\ToggleCheck::resolve(['label' => '','name' => 'permissions[]','value' => ''.e($module['slug']).'.delete','width' => 'col-6','checkBoxClass' => '','checked' => ''.e($permissions->contains($module['slug'].'.delete') ? 'true' : 'false').''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.toggle-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\ToggleCheck::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($module['slug']).'.delete']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal011326ec41fbfadf01351df3028773ad)): ?>
<?php $component = $__componentOriginal011326ec41fbfadf01351df3028773ad; ?>
<?php unset($__componentOriginal011326ec41fbfadf01351df3028773ad); ?>
<?php endif; ?></span></td>
                
            </tr>
           <?php endif; ?> 

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </tbody>
      </table>
      
      <input type="hidden" name="redirect" value="<?php echo e(url()->previous()); ?>">
      <input type="hidden" name="role_id" value="<?php echo e($role->id); ?>">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check(['role.edit'])): ?>
      <button class="btn bg-primary text-light text-bold ms-auto mb-0 btn-ladda" type="submit" title="Submit" data-style="expand-left">Submit</button>
      <?php endif; ?>

     </form>

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
    // select all
    $('body').on('click','a#select_all','click',function(e){
        e.preventDefault();
        var siblingsCheckbox = $(this).parent().siblings().find('input');
        var siblingsSelectScope = $(this).parent().siblings().find('select');
        siblingsCheckbox.attr('checked','true');
        siblingsSelectScope.attr('required','true');
        $(this).text('Unsellect All');
        $(this).attr('id','unselect_all');
    })
    // unselect all
    $('body').on('click','a#unselect_all',function(e){
        e.preventDefault();
        var siblingsCheckbox = $(this).parent().siblings().find('input');
        var siblingsSelectScope = $(this).parent().siblings().find('select');
        siblingsCheckbox.removeAttr('checked');
        siblingsSelectScope.removeAttr('required');
        $(this).text('Select All');
        $(this).attr('id','select_all');
    })

    // makin scope mandatory incase a checkbox is selected in a module
    $('input:checkbox').on('click',function(){
        siblingSelectScope = $(this).parent().parent().siblings().find('select');
        allsiblings = $(this).parent().parent().siblings().find('input:checked');

        // if this input is checked then we make scope mandatory
        if ($(this).is(':checked')) {
           siblingSelectScope.attr('required','true');
        }else{
            // if its not checked but its any sibling checked then we still make scope mandoatry
            if (allsiblings.length > 0) {
             siblingSelectScope.attr('required','true');
            }else{
                siblingSelectScope.removeAttr('required');
            }
        }
    })

    // updating existing data into this view
  
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/roles/show.blade.php ENDPATH**/ ?>