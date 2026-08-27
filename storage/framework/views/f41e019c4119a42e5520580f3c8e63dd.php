<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'locale',
    'label',
    'flag' => null,
    'avatar' => null,
    'isCompact' => false,
    'isCircular' => false,
    'isModal' => false,
    'flagHeight' => 'h-16',
    'avatarHeight' => 'size-8',
]));

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

foreach (array_filter(([
    'locale',
    'label',
    'flag' => null,
    'avatar' => null,
    'isCompact' => false,
    'isCircular' => false,
    'isModal' => false,
    'flagHeight' => 'h-16',
    'avatarHeight' => 'size-8',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $isActive = app()->isLocale($locale);
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isModal && $isCompact && $flag): ?>
    
    <button
        type="button"
        <?php if(! $isActive): ?>
            wire:click="changeLocale('<?php echo e($locale); ?>')"
        <?php endif; ?>
        x-tooltip="{
            content: <?php echo \Illuminate\Support\Js::from($label)->toHtml() ?>,
            theme: $store.theme,
        }"
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'fi-ls-item group relative rounded-xl shadow-sm p-2 outline-none overflow-visible bg-gray-50 ring-1 dark:bg-gray-400/10',
            'ring-primary-500/50 dark:ring-primary-400 pointer-events-none' => $isActive,
            'ring-gray-950/5 dark:ring-white/10 hover:ring-gray-950/10 dark:hover:ring-white/15 transition-colors duration-75 ease-in' => ! $isActive,
        ]); ?>"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isActive): ?>
            <span class="absolute -top-1.5 -end-1.5 z-10 flex size-5 items-center justify-center rounded-full ring-2 ring-white bg-primary-600 shadow-sm dark:ring-gray-900 dark:bg-primary-500">
                <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['icon' => 'heroicon-s-check','class' => 'size-3 text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'heroicon-s-check','class' => 'size-3 text-white']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $attributes = $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $component = $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <img
            src="<?php echo e($flag); ?>"
            alt="<?php echo e($label); ?>"
            loading="lazy"
            class="<?php echo \Illuminate\Support\Arr::toCssClasses(['block w-full rounded-lg object-cover group-hover:scale-105 transition-transform duration-75 ease-in', $flagHeight]); ?>"
        />
    </button>

<?php elseif($isModal): ?>
    
    <button
        type="button"
        <?php if(! $isActive): ?>
            wire:click="changeLocale('<?php echo e($locale); ?>')"
        <?php endif; ?>
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'fi-ls-item relative group flex items-center shadow-sm gap-3 rounded-lg p-3 transition duration-75 outline-none',
            'ring-1 ring-primary-500/20 bg-primary-50 dark:ring-primary-400/20 dark:bg-primary-400/10 pointer-events-none' => $isActive,
            'ring-1 ring-gray-950/8 bg-white hover:ring-primary-500/30 hover:bg-primary-50 dark:ring-white/8 dark:bg-white/5 dark:hover:ring-primary-400/20 dark:hover:bg-primary-400/10' => ! $isActive,
        ]); ?>"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isActive): ?>
            <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['icon' => 'heroicon-s-check-circle','class' => 'absolute top-2 end-2 h-4 w-4 text-primary-600 dark:text-primary-500']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'heroicon-s-check-circle','class' => 'absolute top-2 end-2 h-4 w-4 text-primary-600 dark:text-primary-500']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $attributes = $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $component = $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($flag): ?>
            <?php if (isset($component)) { $__componentOriginalb02c476b360cb2be8d1c430c1c6c1bf1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb02c476b360cb2be8d1c430c1c6c1bf1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'language-switch::components.flag','data' => ['src' => $flag,'alt' => $label,'class' => \Illuminate\Support\Arr::toCssClasses(['group-hover:scale-105 transition-transform duration-150 ease-in', 'fi-circular' => $isCircular])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('language-switch::flag'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($flag),'alt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses(['group-hover:scale-105 transition-transform duration-150 ease-in', 'fi-circular' => $isCircular]))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb02c476b360cb2be8d1c430c1c6c1bf1)): ?>
<?php $attributes = $__attributesOriginalb02c476b360cb2be8d1c430c1c6c1bf1; ?>
<?php unset($__attributesOriginalb02c476b360cb2be8d1c430c1c6c1bf1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb02c476b360cb2be8d1c430c1c6c1bf1)): ?>
<?php $component = $__componentOriginalb02c476b360cb2be8d1c430c1c6c1bf1; ?>
<?php unset($__componentOriginalb02c476b360cb2be8d1c430c1c6c1bf1); ?>
<?php endif; ?>
        <?php elseif($avatar): ?>
            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'fi-ls-avatar flex items-center justify-center shrink-0 font-semibold text-xs',
                $avatarHeight,
                'rounded-full' => $isCircular,
                'rounded-md' => ! $isCircular,
                'bg-gray-50 dark:bg-white/5 text-primary-600 dark:text-primary-400' => $isActive,
                'bg-gray-100 text-gray-600 dark:bg-white/5 dark:text-gray-400 group-hover:bg-white group-hover:text-primary-500 dark:group-hover:text-primary-400 dark:group-hover:bg-white/10' => ! $isActive,
            ]); ?>">
                <?php echo e($avatar); ?>

            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'text-sm font-medium',
            'text-primary-600 dark:text-primary-400' => $isActive,
            'text-gray-700 dark:text-gray-200' => ! $isActive,
        ]); ?>">
            <?php echo e($label); ?>

        </span>
    </button>

<?php else: ?>
    
    <button
        type="button"
        <?php if(! $isActive): ?>
            wire:click="changeLocale('<?php echo e($locale); ?>')"
        <?php endif; ?>
        <?php if($isCompact): ?>
            x-tooltip="{
                content: <?php echo \Illuminate\Support\Js::from($label)->toHtml() ?>,
                theme: $store.theme,
            }"
        <?php endif; ?>
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'fi-dropdown-list-item fi-ls-item whitespace-nowrap',
            'bg-primary-50 dark:bg-primary-400/10 pointer-events-none' => $isActive,
            'justify-center p-1.5' => $isCompact,
        ]); ?>"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($flag): ?>
            <?php if (isset($component)) { $__componentOriginalb02c476b360cb2be8d1c430c1c6c1bf1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb02c476b360cb2be8d1c430c1c6c1bf1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'language-switch::components.flag','data' => ['src' => $flag,'alt' => $label,'class' => \Illuminate\Support\Arr::toCssClasses([
                    $isCompact ? 'h-7 w-11 rounded-sm! object-cover' : 'fi-size-sm',
                    'fi-circular' => $isCircular && ! $isCompact,
                ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('language-switch::flag'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($flag),'alt' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($label),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                    $isCompact ? 'h-7 w-11 rounded-sm! object-cover' : 'fi-size-sm',
                    'fi-circular' => $isCircular && ! $isCompact,
                ]))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb02c476b360cb2be8d1c430c1c6c1bf1)): ?>
<?php $attributes = $__attributesOriginalb02c476b360cb2be8d1c430c1c6c1bf1; ?>
<?php unset($__attributesOriginalb02c476b360cb2be8d1c430c1c6c1bf1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb02c476b360cb2be8d1c430c1c6c1bf1)): ?>
<?php $component = $__componentOriginalb02c476b360cb2be8d1c430c1c6c1bf1; ?>
<?php unset($__componentOriginalb02c476b360cb2be8d1c430c1c6c1bf1); ?>
<?php endif; ?>
        <?php elseif($avatar): ?>
            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'fi-ls-avatar flex size-6 items-center justify-center shrink-0 font-semibold text-xs',
                'rounded-full' => $isCircular,
                'rounded-md' => ! $isCircular,
                'bg-primary-500/20 text-primary-600 dark:text-primary-400' => $isActive,
                'bg-gray-100 text-gray-600 dark:bg-white/5 dark:text-gray-400' => ! $isActive,
            ]); ?>">
                <?php echo e($avatar); ?>

            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if (! ($isCompact)): ?>
            <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'fi-dropdown-list-item-label',
                'text-primary-600 dark:text-primary-400' => $isActive,
            ]); ?>">
                <?php echo e($label); ?>

            </span>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isActive): ?>
                <?php if (isset($component)) { $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['icon' => 'heroicon-m-check-circle','class' => 'ms-auto h-5 w-5 shrink-0 text-primary-600 dark:text-primary-400']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'heroicon-m-check-circle','class' => 'ms-auto h-5 w-5 shrink-0 text-primary-600 dark:text-primary-400']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $attributes = $__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__attributesOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950)): ?>
<?php $component = $__componentOriginalbfc641e0710ce04e5fe02876ffc6f950; ?>
<?php unset($__componentOriginalbfc641e0710ce04e5fe02876ffc6f950); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </button>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\wamp64\www\FillamentApp\vendor\bezhansalleh\filament-language-switch\resources\views/components/locale-item.blade.php ENDPATH**/ ?>