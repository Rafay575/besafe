<?php $__env->startSection('breadcrumb'); ?>
<?php if (isset($component)) { $__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e = $component; } ?>
<?php $component = App\View\Components\Templates\BreadCrumb::resolve(['pageTitle' => 'Show User Profile'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('templates.bread-crumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Templates\BreadCrumb::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
  <li class="breadcrumb-item text-sm text-white"><a class="text-white" href="<?php echo e(route('users.index')); ?>">Show User Profile</a></li>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e)): ?>
<?php $component = $__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e; ?>
<?php unset($__componentOriginal1a56a60d99bb6840bc5bc51d3eb3d41e); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $user = auth()->user();
?>
<?php if (isset($component)) { $__componentOriginald6b053c3f0a17a40778ef03aa609c293 = $component; } ?>
<?php $component = App\View\Components\Templates\BasicPageTemp::resolve(['pageTitle' => 'View User Profile','pageDesc' => 'View User Details'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
              
            </div>
          </div>
         <?php $__env->endSlot(); ?>
        

        
      <div class="row container">
        <div class="col-12 col-sm-8">
            <form class="row ajax-form" action="<?php echo e(route('users.profileStore')); ?>" method="POST">
                <?php echo method_field('PUT'); ?>
                <?php echo csrf_field(); ?>
                <div class="row mt-3">
                    <?php if (isset($component)) { $__componentOriginala82af144660956e7837aa14fa51ca2ac = $component; } ?>
<?php $component = App\View\Components\Forms\BasicInput::resolve(['label' => 'First Name','name' => 'first_name','type' => 'text','value' => ''.e(isset($user) ? $user->first_name : '').'','width' => 'col-12 col-sm-6','inputClass' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.basic-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\BasicInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'eg. Ali','required' => true]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala82af144660956e7837aa14fa51ca2ac)): ?>
<?php $component = $__componentOriginala82af144660956e7837aa14fa51ca2ac; ?>
<?php unset($__componentOriginala82af144660956e7837aa14fa51ca2ac); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala82af144660956e7837aa14fa51ca2ac = $component; } ?>
<?php $component = App\View\Components\Forms\BasicInput::resolve(['label' => 'Last Name','name' => 'last_name','type' => 'text','value' => ''.e(isset($user) ? $user->last_name : '').'','width' => 'col-12 col-sm-6 mt-3 mt-sm-0','inputClass' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.basic-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\BasicInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'eg. Zeb','required' => true]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala82af144660956e7837aa14fa51ca2ac)): ?>
<?php $component = $__componentOriginala82af144660956e7837aa14fa51ca2ac; ?>
<?php unset($__componentOriginala82af144660956e7837aa14fa51ca2ac); ?>
<?php endif; ?>
                  </div>
                  <div class="row mt-3">
                    <?php if (isset($component)) { $__componentOriginala82af144660956e7837aa14fa51ca2ac = $component; } ?>
<?php $component = App\View\Components\Forms\BasicInput::resolve(['label' => 'Mobile','name' => 'mobile','type' => 'text','value' => ''.e(isset($user) ? $user->mobile : '').'','width' => 'col-12 col-sm-6','inputClass' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.basic-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\BasicInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'eg. xxx-xxxxxxx','patterns' => '\d{3}-?\d{2}-?\d{4}','required' => true]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala82af144660956e7837aa14fa51ca2ac)): ?>
<?php $component = $__componentOriginala82af144660956e7837aa14fa51ca2ac; ?>
<?php unset($__componentOriginala82af144660956e7837aa14fa51ca2ac); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala82af144660956e7837aa14fa51ca2ac = $component; } ?>
<?php $component = App\View\Components\Forms\BasicInput::resolve(['label' => 'Email','name' => 'email','type' => 'email','value' => ''.e(isset($user) ? $user->email : '').'','width' => 'col-12 col-sm-6 mt-3 mt-sm-0','inputClass' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.basic-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\BasicInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'eg. ali.zeb@gmail.com']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala82af144660956e7837aa14fa51ca2ac)): ?>
<?php $component = $__componentOriginala82af144660956e7837aa14fa51ca2ac; ?>
<?php unset($__componentOriginala82af144660956e7837aa14fa51ca2ac); ?>
<?php endif; ?>
                  </div>

                  <div class="row mt-3">
                      <?php if (isset($component)) { $__componentOriginal7fc94254d9abaf24a03227ddcffc5126 = $component; } ?>
<?php $component = App\View\Components\Forms\TextArea::resolve(['label' => 'Permanent Address','name' => 'perm_address','width' => 'col-12','textAreaClass' => '','cols' => '2','rows' => '2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-area'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextArea::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(isset($user) ? $user->perm_address : ''); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fc94254d9abaf24a03227ddcffc5126)): ?>
<?php $component = $__componentOriginal7fc94254d9abaf24a03227ddcffc5126; ?>
<?php unset($__componentOriginal7fc94254d9abaf24a03227ddcffc5126); ?>
<?php endif; ?>
                      <?php if (isset($component)) { $__componentOriginal7fc94254d9abaf24a03227ddcffc5126 = $component; } ?>
<?php $component = App\View\Components\Forms\TextArea::resolve(['label' => 'Residential Address','name' => 'res_address','width' => 'col-12','textAreaClass' => '','cols' => '2','rows' => '2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-area'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextArea::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e(isset($user) ? $user->res_address : ''); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7fc94254d9abaf24a03227ddcffc5126)): ?>
<?php $component = $__componentOriginal7fc94254d9abaf24a03227ddcffc5126; ?>
<?php unset($__componentOriginal7fc94254d9abaf24a03227ddcffc5126); ?>
<?php endif; ?>
                      <?php if (isset($component)) { $__componentOriginala82af144660956e7837aa14fa51ca2ac = $component; } ?>
<?php $component = App\View\Components\Forms\BasicInput::resolve(['label' => 'Password','name' => 'password','type' => 'password','value' => '','width' => 'col-6','inputClass' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.basic-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\BasicInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'password','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(!isset($user))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala82af144660956e7837aa14fa51ca2ac)): ?>
<?php $component = $__componentOriginala82af144660956e7837aa14fa51ca2ac; ?>
<?php unset($__componentOriginala82af144660956e7837aa14fa51ca2ac); ?>
<?php endif; ?>
                      <?php if (isset($component)) { $__componentOriginala82af144660956e7837aa14fa51ca2ac = $component; } ?>
<?php $component = App\View\Components\Forms\BasicInput::resolve(['label' => 'Confirm Password','name' => 'password_confirmation','type' => 'password','value' => '','width' => 'col-6','inputClass' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.basic-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\BasicInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => 'confirm password','required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(!isset($user))]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala82af144660956e7837aa14fa51ca2ac)): ?>
<?php $component = $__componentOriginala82af144660956e7837aa14fa51ca2ac; ?>
<?php unset($__componentOriginala82af144660956e7837aa14fa51ca2ac); ?>
<?php endif; ?>
                      <?php if (isset($component)) { $__componentOriginala82af144660956e7837aa14fa51ca2ac = $component; } ?>
<?php $component = App\View\Components\Forms\BasicInput::resolve(['label' => '','name' => 'image','type' => 'file','value' => '','width' => 'col-12','inputClass' => ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.basic-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\BasicInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => '']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala82af144660956e7837aa14fa51ca2ac)): ?>
<?php $component = $__componentOriginala82af144660956e7837aa14fa51ca2ac; ?>
<?php unset($__componentOriginala82af144660956e7837aa14fa51ca2ac); ?>
<?php endif; ?>
                  </div>

                 <div class="row mt-3 mb-5">
                    <div class="col-2">
                        <input type="hidden" name="redirect" value="<?php echo e(url()->previous()); ?>">
                        <button class="btn bg-gradient-primary mb-0 btn-ladda" type="submit" title="Send" data-style="expand-left">Update</button>
                    </div>
                </div> 
            </form>   

        </div>
        <div class="other_info col-4">
        <img src="<?php echo e((isset($user) && $user->image != "") ? asset('images/profile/' . $user->image) : asset('images/profile/User.ico')); ?>" class="img-fluid border-radius-lg shadow-lg max-height-500"  alt="avatar"><br>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald6b053c3f0a17a40778ef03aa609c293)): ?>
<?php $component = $__componentOriginald6b053c3f0a17a40778ef03aa609c293; ?>
<?php unset($__componentOriginald6b053c3f0a17a40778ef03aa609c293); ?>
<?php endif; ?> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\flexi\resources\views/users/profile.blade.php ENDPATH**/ ?>