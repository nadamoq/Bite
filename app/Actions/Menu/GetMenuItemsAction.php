<?php

namespace App\Actions\Menu;

use App\Models\Category;
use App\Models\MenuItems;

class GetMenuItemsAction
{
    /**
     * Execute the action to get categories and menu items formatted for frontend.
     */
    public function execute(?string $search = null, ?string $categoryId = null, ?string $locale = null): array
    {
        $locale = in_array($locale, ['ar', 'en'], true) ? $locale : app()->getLocale();
        app()->setLocale($locale);

        $categories = Category::active()
            ->select('id', 'title', 'slug')
            ->orderBy('id')
            ->get();

        $menuitems = MenuItems::active()
            ->search($search)
            ->byCategory($categoryId)
            ->with(['category', 'addonCategories.activeAddons', 'addons.category'])
            ->orderBy('category_id')
            ->orderBy('name')
            ->get()
            ->map(fn (MenuItems $item) => $item->toFrontendArray());

        return [
            'categories' => $categories,
            'items' => $menuitems->values()->toArray(),
            'meta' => [
                'total_items' => $menuitems->count(),
                'total_categories' => $categories->count(),
                'timestamp' => now()->toIso8601String(),
            ],
        ];
    }
}
