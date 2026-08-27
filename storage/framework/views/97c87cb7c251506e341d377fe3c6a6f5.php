<?php
    use BezhanSalleh\LanguageSwitch\Enums\ItemStyle;

    $isModal = $displayMode === \BezhanSalleh\LanguageSwitch\Enums\DisplayMode::Modal;
    $isCompact = $itemStyle->isCompact();

    // In modal mode, AvatarOnly falls back to LabelOnly — the avatar is too
    // small for a showcase card. Flag and label styles render as expected.
    $showFlag = $itemStyle->hasVisual() && $hasFlags;
    $showAvatar = $itemStyle->hasVisual()
        && ! $hasFlags
        && ! ($isModal && $itemStyle === ItemStyle::AvatarOnly);
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isModal): ?>
    
    <div
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'grid',
            'gap-4' => ! $isCompact,
            'gap-4 justify-center' => $isCompact,
        ]); ?>"
        style="<?php echo \Illuminate\Support\Arr::toCssStyles([
            "grid-template-columns: repeat({$columns}, minmax(0, 1fr))" => ! $isCompact && $columns > 1,
            "grid-template-columns: repeat(auto-fit, minmax(5rem, 1fr))" => $isCompact && $columns <= 1,
            "grid-template-columns: repeat({$columns}, 6rem)" => $isCompact && $columns > 1,
        ]) ?>"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php echo $__env->make('language-switch::components.locale-item', [
                'locale' => $locale,
                'label' => $ls->getLabel($locale),
                'flag' => $showFlag ? $ls->getFlag($locale) : null,
                'avatar' => $showAvatar ? $ls->getAvatar($locale) : null,
                'isCompact' => $isCompact,
                'isCircular' => $isCircular,
                'isModal' => true,
                'flagHeight' => $flagHeight,
                'avatarHeight' => $avatarHeight,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
<?php else: ?>
    
    <?php if (isset($component)) { $__componentOriginal66687bf0670b9e16f61e667468dc8983 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66687bf0670b9e16f61e667468dc8983 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.dropdown.list.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::dropdown.list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php echo $__env->make('language-switch::components.locale-item', [
                'locale' => $locale,
                'label' => $ls->getLabel($locale),
                'flag' => $showFlag ? $ls->getFlag($locale) : null,
                'avatar' => $showAvatar ? $ls->getAvatar($locale) : null,
                'isCompact' => $isCompact,
                'isCircular' => $isCircular,
                'isModal' => false,
                'flagHeight' => $flagHeight,
                'avatarHeight' => $avatarHeight,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66687bf0670b9e16f61e667468dc8983)): ?>
<?php $attributes = $__attributesOriginal66687bf0670b9e16f61e667468dc8983; ?>
<?php unset($__attributesOriginal66687bf0670b9e16f61e667468dc8983); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66687bf0670b9e16f61e667468dc8983)): ?>
<?php $component = $__componentOriginal66687bf0670b9e16f61e667468dc8983; ?>
<?php unset($__componentOriginal66687bf0670b9e16f61e667468dc8983); ?>
<?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\wamp64\www\FillamentApp\vendor\bezhansalleh\filament-language-switch\resources\views/partials/list.blade.php ENDPATH**/ ?>