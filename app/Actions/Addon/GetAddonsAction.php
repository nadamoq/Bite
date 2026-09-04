<?php

namespace App\Actions\Addon;

use App\Models\Addon;

class GetAddonsAction
{
    /**
     * Execute the action to get all active addons formatted.
     */
    public function execute(?string $locale = null): array
    {
        $locale = in_array($locale, ['ar', 'en'], true) ? $locale : app()->getLocale();
        app()->setLocale($locale);

        $addons = Addon::active()
            ->with('activeCategory')
            ->get()
            ->map(function (Addon $addon) {
                $nameTranslations = method_exists($addon, 'translationsMap')
                    ? $addon->translationsMap('name')
                    : ['ar' => $addon->name, 'en' => $addon->name];

                $categoryTranslations = $addon->category && method_exists($addon->category, 'translationsMap')
                    ? $addon->category->translationsMap('name')
                    : ['ar' => $addon->category?->name ?? '', 'en' => $addon->category?->name ?? ''];

                return [
                    'id' => $addon->id,
                    'name' => [
                        'ar' => $nameTranslations['ar'] ?? '',
                        'en' => $nameTranslations['en'] ?? $nameTranslations['ar'] ?? '',
                    ],
                    'price' => (float) $addon->price,
                    'image' => $addon->image,
                    'category_id' => $addon->addon_category_id,
                    'category' => $addon->category ? [
                        'id' => $addon->category->id,
                        'name' => [
                            'ar' => $categoryTranslations['ar'] ?? '',
                            'en' => $categoryTranslations['en'] ?? $categoryTranslations['ar'] ?? '',
                        ],
                    ] : null,
                ];
            });

        return [
            'addons' => $addons->values()->toArray(),
            'total' => $addons->count(),
        ];
    }
}
