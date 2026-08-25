<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItems;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Fetch all active menu items grouped by category with addons
     * This endpoint serves as the single source of truth for frontend menu data
     * 
     * State Management:
     * - Frontend maintains immutable master copy (allMenuItems)
     * - Frontend filters from master, never from partially-filtered data
     * - Backend returns complete dataset; filtering happens on client
     * 
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $categories = Category::select('id', 'title', 'slug')
            ->where('is_active', true)
            ->orderBy('id')
            ->get();
        
        $search = $request->query('search');
        $categoryId = $request->query('category_id');

        $menuitems = MenuItems::where('is_active', true)
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->when($categoryId && $categoryId !== 'all', function ($query) use ($categoryId) {
                if (is_numeric($categoryId)) {
                    return $query->where('category_id', $categoryId);
                } else {
                    return $query->whereHas('category', function ($q) use ($categoryId) {
                        $q->where('slug', $categoryId);
                    });
                }
            })
            ->with(['category', 'addonCategories.activeAddons'])
            ->orderBy('category_id')
            ->orderBy('name')
            ->get()
            ->map(function ($menuitem) {
                return [
                    'id' => $menuitem->id,
                    'category' => $menuitem->category?->slug ?? 'uncategorized',  // Use slug for frontend filtering
                    'category_id' => $menuitem->category_id,
                    'price' => (float) $menuitem->price,
                    'image' => $menuitem->imageUrl,
                    'name' => [
                        'ar' => $menuitem->name,
                        'en' => $menuitem->name
                    ],
                    'description' => $menuitem->description,
                    'desc' => [
                        'ar' => $menuitem->description,
                        'en' => $menuitem->description
                    ],
                    'rating' => '4.8',
                    'badges' => [],
                    'addon_categories' => $menuitem->addonCategories
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
            });
       
        return response()->json([
            'success' => true,
            'categories' => $categories,
            'items' => $menuitems->values(), 
            'meta' => [
                'total_items' => $menuitems->count(),
                'total_categories' => $categories->count(),
                'timestamp' => now()->toIso8601String()
            ]
        ]);
    }
}

