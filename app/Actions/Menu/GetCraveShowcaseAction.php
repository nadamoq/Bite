<?php

namespace App\Actions\Menu;

use App\Models\Category;
use App\Models\MenuItems;

class GetCraveShowcaseAction
{
    /**
     * Badges to rotate across category showcase cards.
     */
    private const BADGES = ['chef-special', 'crispy-hot', 'extra-cheese', 'bestseller'];

    /**
     * Execute the action to get primary featured dish and category recommendations.
     *
     * @return array{featuredDish: ?array, showcaseDishes: array}
     */
    public function execute(): array
    {
        // 1. Fetch Primary Featured Dish (#1 overall best-selling item)
        $primaryFeatured = MenuItems::active()
            ->popular()
            ->with(['category', 'addonCategories.activeAddons'])
            ->first();

        // Fallback if no order items exist yet
        if (!$primaryFeatured) {
            $primaryFeatured = MenuItems::active()
                ->with(['category', 'addonCategories.activeAddons'])
                ->first();
        }

        $primaryFeaturedFormatted = $primaryFeatured
            ? $primaryFeatured->toFrontendArray('bestseller')
            : null;

        // 2. Fetch Top-Selling Item from 3 to 4 distinct categories
        $primaryCategoryId = $primaryFeatured?->category_id;

        $categories = Category::active()
            ->when($primaryCategoryId, fn ($q) => $q->where('id', '!=', $primaryCategoryId))
            ->limit(4)
            ->get();

        $recommendations = [];

        foreach ($categories as $index => $category) {
            $item = MenuItems::active()
                ->where('category_id', $category->id)
                ->popular()
                ->with(['category', 'addonCategories.activeAddons'])
                ->first();

            if ($item) {
                $badgeKey = self::BADGES[$index % count(self::BADGES)];
                $recommendations[] = $item->toFrontendArray($badgeKey);
            }
        }

        return [
            'featuredDish' => $primaryFeaturedFormatted,
            'showcaseDishes' => $recommendations,
        ];
    }
}
