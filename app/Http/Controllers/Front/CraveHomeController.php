<?php

namespace App\Http\Controllers\Front;

use App\Actions\Menu\GetCraveShowcaseAction;
use App\Actions\Menu\GetMenuItemsAction;
use App\Http\Controllers\Controller;
use App\Models\AddonCategory;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class CraveHomeController extends Controller
{
    /**
     * Display the dynamic Crave landing page populated with live database records.
     */
    public function index(
        GetCraveShowcaseAction $showcaseAction,
        GetMenuItemsAction $menuItemsAction
    ): View {
        $showcaseData = $showcaseAction->execute();
        $menuData = $menuItemsAction->execute();

        $categories = Category::active()
            ->select('id', 'title', 'slug')
            ->orderBy('id')
            ->get()
            ->map(function ($category) {
                $rawTitle = $category->title ?? $category->name ?? '';
                $title = is_array($rawTitle) ? $rawTitle : ['ar' => $rawTitle, 'en' => $rawTitle];
                $name = $title['ar'] ?? $title['en'] ?? (string) $rawTitle;

                return [
                    'id' => (int) $category->id,
                    'slug' => $category->slug,
                    'title' => $name,
                    'name' => $name,
                    'label' => [
                        'ar' => $title['ar'] ?? $name,
                        'en' => $title['en'] ?? $name,
                    ],
                ];
            })
            ->values()
            ->all();

        $addonCategories = AddonCategory::active()
            ->with(['activeAddons'])
            ->get();

        return view('food.crave', [
            'featuredDish' => $showcaseData['featuredDish'],
            'familyDish' => $showcaseData['familyDish'],
            'spicyDish' => $showcaseData['spicyDish'],
            'showcaseDishes' => $showcaseData['showcaseDishes'],
            'menuItems' => $menuData['items'],
            'categories' => $categories,
            'addonCategories' => $addonCategories,
        ]);
    }
}
