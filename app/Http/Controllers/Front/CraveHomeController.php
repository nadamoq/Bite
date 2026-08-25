<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CraveHomeController extends Controller
{
    /**
     * Display the dynamic Crave landing page.
     */
    public function index()
    {
        // 1. Fetch Primary Featured Item (#1 overall most popular item)
        $primaryFeatured = MenuItems::where('is_active', true)
            ->leftJoin('order_items', 'menu_items.id', '=', 'order_items.menuitem_id')
            ->select('menu_items.*')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
            ->groupBy('menu_items.id')
            ->orderByDesc('total_sold')
            ->orderByDesc('price')
            ->with(['category', 'addonCategories.activeAddons'])
            ->first();

        // Fallback if no item found
        if (!$primaryFeatured) {
            $primaryFeatured = MenuItems::where('is_active', true)
                ->with(['category', 'addonCategories.activeAddons'])
                ->first();
        }

        $primaryFeaturedFormatted = $primaryFeatured ? $this->formatItem($primaryFeatured, 'bestseller') : null;

        // 2. Fetch Top-Selling Item from 3 to 4 distinct categories (excluding primary category if available)
        $primaryCategoryId = $primaryFeatured ? $primaryFeatured->category_id : null;

        $categories = Category::where('is_active', true)
            ->when($primaryCategoryId, function ($query) use ($primaryCategoryId) {
                return $query->where('id', '!=', $primaryCategoryId);
            })
            ->limit(4)
            ->get();

        $recommendations = collect();
        $badges = ['chef-special', 'crispy-hot', 'extra-cheese', 'bestseller'];
        
        foreach ($categories as $index => $category) {
            $item = MenuItems::where('is_active', true)
                ->where('category_id', $category->id)
                ->leftJoin('order_items', 'menu_items.id', '=', 'order_items.menuitem_id')
                ->select('menu_items.*')
                ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
                ->groupBy('menu_items.id')
                ->orderByDesc('total_sold')
                ->orderByDesc('price')
                ->with(['category', 'addonCategories.activeAddons'])
                ->first();

            if ($item) {
                // Assign a rotating badge for visual interest
                $badgeKey = $badges[$index % count($badges)];
                $recommendations->push($this->formatItem($item, $badgeKey));
            }
        }

        return view('food.crave', [
            'featuredDish' => $primaryFeaturedFormatted,
            'showcaseDishes' => $recommendations->values()->toArray(),
        ]);
    }

    /**
     * Format a MenuItems model to match the frontend JSON structure.
     */
    private function formatItem(MenuItems $item, string $badgeType): array
    {
        $badgeTranslations = [
            'bestseller' => ['ar' => 'الأكثر مبيعاً', 'en' => 'Bestseller', 'class' => 'bg-green-500/30 text-green-200 backdrop-blur-md'],
            'chef-special' => ['ar' => 'طبق الشيف', 'en' => "Chef's Special", 'class' => 'bg-purple-500/30 text-purple-200 backdrop-blur-md'],
            'crispy-hot' => ['ar' => 'مقرمش وساخن', 'en' => 'Crispy & Hot', 'class' => 'bg-crimson-cta/30 text-crimson-hot backdrop-blur-md'],
            'extra-cheese' => ['ar' => 'جبنة إضافية', 'en' => 'Extra Cheese', 'class' => 'bg-amber-glow/30 text-amber-warm backdrop-blur-md'],
        ];

        $badge = $badgeTranslations[$badgeType] ?? $badgeTranslations['bestseller'];

        return [
            'id' => $item->id,
            'category' => $item->category?->slug ?? 'uncategorized',
            'category_id' => $item->category_id,
            'price' => (float) $item->price,
            'image' => $item->imageUrl,
            'name' => [
                'ar' => $item->name,
                'en' => $item->name
            ],
            'description' => $item->description,
            'desc' => [
                'ar' => $item->description,
                'en' => $item->description
            ],
            'rating' => '4.8',
            'badge' => [
                'ar' => $badge['ar'],
                'en' => $badge['en']
            ],
            'badgeClass' => $badge['class'],
            'badges' => [$badgeType],
            'addon_categories' => $item->addonCategories
                ->map(function ($addonCat) {
                    return [
                        'id' => $addonCat->id,
                        'name' => [
                            'ar' => $addonCat->name,
                            'en' => $addonCat->name,
                        ],
                        'is_multiple' => (bool) $addonCat->is_multiple,
                        'addons' => $addonCat->activeAddons
                            ->map(function ($addon) {
                                return [
                                    'id' => $addon->id,
                                    'name' => [
                                        'ar' => $addon->name,
                                        'en' => $addon->name,
                                    ],
                                    'price' => (float) $addon->price,
                                    'image' => $addon->image,
                                ];
                            })
                            ->values()
                            ->toArray()
                    ];
                })
                ->values()
                ->toArray()
        ];
    }
}
