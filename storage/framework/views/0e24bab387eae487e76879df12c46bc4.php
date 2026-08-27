<?php if (isset($component)) { $__componentOriginal22ab0dbc2c6619d5954111bba06f01db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.index','data' => ['teleport' => $layout->shouldTeleport,'placement' => $layout->placement,'maxHeight' => $maxHeight,'class' => \Illuminate\Support\Arr::toCssClasses([
        '-mx-2' => $layout->spacingKey === 'sidebar-nav',
        'mx-2' => $layout->spacingKey === 'topbar-edge',
        '-me-2' => $layout->spacingKey === 'user-menu-before',
        '-ms-2' => $layout->spacingKey === 'user-menu-after',
        '[&_.fi-dropdown-panel]:overscroll-y-contain',
        '[&_.fi-dropdown-panel]:w-fit' => $itemStyle->isCompact(),
    ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['teleport' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout->shouldTeleport),'placement' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout->placement),'max-height' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($maxHeight),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
        '-mx-2' => $layout->spacingKey === 'sidebar-nav',
        'mx-2' => $layout->spacingKey === 'topbar-edge',
        '-me-2' => $layout->spacingKey === 'user-menu-before',
        '-ms-2' => $layout->spacingKey === 'user-menu-after',
        '[&_.fi-dropdown-panel]:overscroll-y-contain',
        '[&_.fi-dropdown-panel]:w-fit' => $itemStyle->isCompact(),
    ]))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

     <?php $__env->slot('trigger', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginal1fe701e73d20a40cc766c46d8fba6262 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1fe701e73d20a40cc766c46d8fba6262 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'language-switch::components.trigger.index','data' => ['layout' => $layout]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('language-switch::trigger'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['layout' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1fe701e73d20a40cc766c46d8fba6262)): ?>
<?php $attributes = $__attributesOriginal1fe701e73d20a40cc766c46d8fba6262; ?>
<?php unset($__attributesOriginal1fe701e73d20a40cc766c46d8fba6262); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1fe701e73d20a40cc766c46d8fba6262)): ?>
<?php $component = $__componentOriginal1fe701e73d20a40cc766c46d8fba6262; ?>
<?php unset($__componentOriginal1fe701e73d20a40cc766c46d8fba6262); ?>
<?php endif; ?>
     <?php $__env->endSlot(); ?>

    <?php echo $__env->make('language-switch::partials.list', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal22ab0dbc2c6619d5954111bba06f01db)): ?>
<?php $attributes = $__attributesOriginal22ab0dbc2c6619d5954111bba06f01db; ?>
<?php unset($__attributesOriginal22ab0dbc2c6619d5954111bba06f01db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal22ab0dbc2c6619d5954111bba06f01db)): ?>
<?php $component = $__componentOriginal22ab0dbc2c6619d5954111bba06f01db; ?>
<?php unset($__componentOriginal22ab0dbc2c6619d5954111bba06f01db); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\FillamentApp\vendor\bezhansalleh\filament-language-switch\resources\views/partials/dropdown.blade.php ENDPATH**/ ?>