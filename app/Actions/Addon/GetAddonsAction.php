<?php

namespace App\Actions\Addon;

use App\Models\Addon;

class GetAddonsAction
{
    /**
     * Execute the action to get all active addons formatted.
     */
    public function execute(): array
    {
        $addons = Addon::active()
            ->with('activeCategory')
            ->get()
            ->map(function (Addon $addon) {
                return [
                    'id' => $addon->id,
                    'name' => [
                        'ar' => $addon->name,
                        'en' => $addon->name,
                    ],
                    'price' => (float) $addon->price,
                    'image' => $addon->image,
                    'category_id' => $addon->addon_category_id,
                    'category' => $addon->category ? [
                        'id' => $addon->category->id,
                        'name' => $addon->category->name,
                    ] : null,
                ];
            });

        return [
            'addons' => $addons->values()->toArray(),
            'total' => $addons->count(),
        ];
    }
}
