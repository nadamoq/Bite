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
            ->get();

        $addonCategories = AddonCategory::active()
            ->with(['activeAddons'])
            ->get();

        return view('food.crave', [
            'featuredDish' => $showcaseData['featuredDish'],
            'showcaseDishes' => $showcaseData['showcaseDishes'],
            'menuItems' => $menuData['items'],
            'categories' => $categories,
            'addonCategories' => $addonCategories,
        ]);
    }
}
