<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['layout']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['layout']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout->triggerShell === 'dropdown-list-item'): ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout->contentType === 'flag' && $layout->isUrlFlag): ?>
        <?php if (isset($component)) { $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['image' => $layout->flagSrc,'attributes' => $attributes->class(['fi-ls-trigger'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout->flagSrc),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes->class(['fi-ls-trigger']))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php echo e($layout->currentLabel); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78)): ?>
<?php $attributes = $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78; ?>
<?php unset($__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78)): ?>
<?php $component = $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78; ?>
<?php unset($__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78); ?>
<?php endif; ?>
    <?php elseif($layout->contentType === 'avatar'): ?>
        <button <?php echo e($attributes->class(['fi-dropdown-list-item fi-ls-trigger'])); ?>>
            <span class="flex size-5 items-center justify-center shrink-0 font-semibold text-xs text-gray-400 dark:text-gray-500">
                <?php echo e($layout->currentAvatar); ?>

            </span>
            <span class="fi-dropdown-list-item-label"><?php echo e($layout->currentLabel); ?></span>
        </button>
    <?php elseif($layout->contentType === 'label'): ?>
        <button <?php echo e($attributes->class(['fi-dropdown-list-item fi-ls-trigger'])); ?>>
            <span class="fi-dropdown-list-item-label"><?php echo e($layout->currentLabel); ?></span>
        </button>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.item','data' => ['icon' => $layout->triggerIcon,'iconAlias' => 'language-switch::trigger','attributes' => $attributes->class(['fi-ls-trigger'])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown.list.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout->triggerIcon),'icon-alias' => 'language-switch::trigger','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($attributes->class(['fi-ls-trigger']))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php echo e($layout->currentLabel); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78)): ?>
<?php $attributes = $__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78; ?>
<?php unset($__attributesOriginal1bd4d8e254cc40cdb05bd99df3e63f78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78)): ?>
<?php $component = $__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78; ?>
<?php unset($__componentOriginal1bd4d8e254cc40cdb05bd99df3e63f78); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php else: ?>
    <button
        type="button"
        aria-label="<?php echo e($layout->currentLabel); ?>"
        <?php if(! $layout->hasLabel): ?>
            x-tooltip="{ content: <?php echo \Illuminate\Support\Js::from($layout->currentLabel)->toHtml() ?>, theme: $store.theme }"
        <?php endif; ?>
        <?php if($layout->shouldHideWhenCollapsed): ?>
            x-show="$store.sidebar.isOpen"
            x-cloak
        <?php endif; ?>
        <?php
            $isButtonShell = in_array($layout->renderContext, ['topbar', 'outside-panel'], true);
        ?>
        <?php echo e($attributes->class([
                'fi-ls-trigger',
                'flex shrink-0 items-center h-9 gap-x-2 transition duration-75 outline-none' => $isButtonShell,
                'bg-gray-100 dark:bg-gray-800' => $layout->renderContext === 'topbar',
                'bg-white dark:bg-gray-900 shadow ring-1 ring-gray-950/5 dark:ring-white/10' => $layout->renderContext === 'outside-panel',
                'w-9 justify-center' => $isButtonShell && ! $layout->hasLabel,
                'px-3' => $isButtonShell && $layout->hasLabel,
                'rounded-full' => $isButtonShell && $layout->isCircular,
                'rounded-lg' => $isButtonShell && ! $layout->isCircular,
                'fi-sidebar-item-btn w-full hover:bg-gray-100 focus-visible:bg-gray-100 dark:hover:bg-white/5 dark:focus-visible:bg-white/5' => $layout->sidebarVariant === 'nav-item',
                'fi-sidebar-database-notifications-btn' => $layout->sidebarVariant === 'footer-item',
            ])); ?>

    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout->hasVisual): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout->contentType === 'flag' && $layout->isUrlFlag): ?>
                <?php if (isset($component)) { $__componentOriginal7aa0b6b1aa4a6b63824d7be5e541d1cb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7aa0b6b1aa4a6b63824d7be5e541d1cb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.avatar','data' => ['src' => $layout->flagSrc,'alt' => $layout->currentLabel,'size' => 'sm','circular' => $layout->isCircular]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout->flagSrc),'alt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout->currentLabel),'size' => 'sm','circular' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($layout->isCircular)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7aa0b6b1aa4a6b63824d7be5e541d1cb)): ?>
<?php $attributes = $__attributesOriginal7aa0b6b1aa4a6b63824d7be5e541d1cb; ?>
<?php unset($__attributesOriginal7aa0b6b1aa4a6b63824d7be5e541d1cb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7aa0b6b1aa4a6b63824d7be5e541d1cb)): ?>
<?php $component = $__componentOriginal7aa0b6b1aa4a6b63824d7be5e541d1cb; ?>
<?php unset($__componentOriginal7aa0b6b1aa4a6b63824d7be5e541d1cb); ?>
<?php endif; ?>
            <?php elseif($layout->contentType === 'avatar'): ?>
                <span class="flex size-5 items-center justify-center shrink-0 font-semibold text-xs text-primary-500 dark:text-primary-400">
                    <?php echo e($layout->currentAvatar); ?>

                </span>
            <?php else: ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout->sidebarVariant === 'nav-item'): ?>
                    <?php echo e(\Filament\Support\generate_icon_html($layout->triggerIcon, 'language-switch::trigger', new \Illuminate\View\ComponentAttributeBag([
                            'class' => 'fi-sidebar-item-icon',
                        ]), size: \Filament\Support\Enums\IconSize::Large)); ?>

                <?php elseif($layout->sidebarVariant === 'footer-item'): ?>
                    <?php echo e(\Filament\Support\generate_icon_html($layout->triggerIcon, 'language-switch::trigger', size: \Filament\Support\Enums\IconSize::Large)); ?>

                <?php else: ?>
                    <?php echo e(\Filament\Support\generate_icon_html($layout->triggerIcon, 'language-switch::trigger', new \Illuminate\View\ComponentAttributeBag([
                            'class' => 'h-5 w-5 text-gray-500 dark:text-gray-400',
                        ]))); ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($layout->hasLabel): ?>
            <span
                <?php if($layout->renderContext === 'sidebar'): ?>
                    x-show="$store.sidebar.isOpen"
                <?php endif; ?>
                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'text-sm font-medium text-gray-700 dark:text-gray-200' => in_array($layout->renderContext, ['topbar', 'outside-panel'], true),
                    'fi-sidebar-item-label text-start' => $layout->sidebarVariant === 'nav-item',
                    'fi-sidebar-database-notifications-btn-label' => $layout->sidebarVariant === 'footer-item',
                ]); ?>"
            ><?php echo e($layout->currentLabel); ?></span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </button>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\wamp64\www\FillamentApp\vendor\bezhansalleh\filament-language-switch\resources\views/components/trigger/index.blade.php ENDPATH**/ ?>