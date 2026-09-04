<?php

namespace App\Http\Controllers\Front;

use App\Actions\Menu\GetMenuItemsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetMenuItemsRequest;
use Illuminate\Http\JsonResponse;

class MenuItemController extends Controller
{
    /**
     * Fetch all active menu items grouped by category with addons.
     * Single source of truth for frontend menu data.
     */
    public function index(GetMenuItemsRequest $request, GetMenuItemsAction $menuItemsAction): JsonResponse
    {
        $lang = $request->validated('lang') ?? $request->header('Accept-Language');

        $result = $menuItemsAction->execute(
            search: $request->validated('search'),
            categoryId: $request->validated('category_id'),
            locale: $lang,
        );

        return response()->json([
            'success' => true,
            ...$result,
        ]);
    }
}
