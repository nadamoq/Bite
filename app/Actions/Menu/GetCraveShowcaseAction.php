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
     * @return array{featuredDish: ?array, familyDish: ?array, spicyDish: ?array, showcaseDishes: array}
     */
    public function execute(): array
    {
        $with = ['category', 'addonCategories.activeAddons'];

        // 1. Fetch Primary Featured Dish (#1 overall best-selling item)
        $primaryFeatured = MenuItems::active()
            ->popular()
            ->with($with)
            ->first();

        // Fallback if no order items exist yet
        if (!$primaryFeatured) {
            $primaryFeatured = MenuItems::active()
                ->with($with)
                ->first();
        }

        $usedIds = array_filter([$primaryFeatured?->id]);

        $primaryFeaturedFormatted = $this->formatSpotlightDish($primaryFeatured, 'bestseller');

        // Family / group meal: num_people >= 5 (legacy Filament select stored 2 for the "5" option)
        $familyMeal = MenuItems::active()
            ->where(function ($q) {
                $q->where('num_people', '>=', 5)
                    ->orWhere('num_people', 2);
            })
            ->when($usedIds, fn ($q) => $q->whereNotIn('id', $usedIds))
            ->with($with)
            ->first();

        if (!$familyMeal) {
            $familyMeal = MenuItems::active()
                ->where(function ($q) {
                    $q->where('num_people', '>=', 5)
                        ->orWhere('num_people', 2);
                })
                ->with($with)
                ->first();
        }

        if ($familyMeal) {
            $usedIds[] = $familyMeal->id;
        }

        $familyDishFormatted = $this->formatSpotlightDish($familyMeal, 'family');

        // Spicy dish: description contains hot/spicy keywords
        $spicyMeal = MenuItems::active()
            ->where(function ($q) {
                $q->where('description', 'LIKE', '%حار%')
                    ->orWhere('description', 'LIKE', '%spicy%');
            })
            ->when($usedIds, fn ($q) => $q->whereNotIn('id', $usedIds))
            ->with($with)
            ->first();

        if (!$spicyMeal) {
            $spicyMeal = MenuItems::active()
                ->where(function ($q) {
                    $q->where('description', 'LIKE', '%حار%')
                        ->orWhere('description', 'LIKE', '%spicy%');
                })
                ->with($with)
                ->first();
        }

        $spicyDishFormatted = $this->formatSpotlightDish($spicyMeal, 'spicy');

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
            'familyDish' => $familyDishFormatted,
            'spicyDish' => $spicyDishFormatted,
            'showcaseDishes' => $recommendations,
        ];
    }

    /**
     * Attach spotlight badge metadata used by the Sensory Showcase cards.
     */
    private function formatSpotlightDish(?MenuItems $item, string $type): ?array
    {
        if (!$item) {
            return null;
        }

        $badgeType = $type === 'bestseller' ? 'bestseller' : ($type === 'spicy' ? 'crispy-hot' : 'chef-special');
        $data = $item->toFrontendArray($badgeType);

        $servingCount = (int) $item->num_people >= 5 ? (int) $item->num_people : 5;

        $spotlights = [
            'bestseller' => [
                'emoji' => '🏆',
                'labelKey' => 'showcase.bestseller_badge',
                'label' => null,
            ],
            'family' => [
                'emoji' => '👨‍👩‍👧‍👦',
                'labelKey' => 'showcase.family_badge',
                'label' => [
                    'ar' => "يكفي {$servingCount} أشخاص",
                    'en' => "Serves {$servingCount}",
                ],
            ],
            'spicy' => [
                'emoji' => '🌶️',
                'labelKey' => 'showcase.spicy_badge',
                'label' => [
                    'ar' => '🌶️ تحدي الحار',
                    'en' => '🌶️ Spicy Challenge',
                ],
            ],
        ];

        $data['spotlight'] = $spotlights[$type];
        $data['spotlightType'] = $type;
        $data['num_people'] = $servingCount;

        return $data;
    }
}
