<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    //
    public function index()
    {
        $addons = Addon::where('is_active', true)
            ->with('activeCategory')
            ->get()
            ->map(function ($addon) {
                return [
                    'id' => $addon->id,
                    'name' => [
                        'ar' => $addon->name,
                        'en' => $addon->name
                    ],
                    'price' => (float) $addon->price,
                    'image' => $addon->image,
                    'category_id' => $addon->addon_category_id,
                    'category' => $addon->category ? [
                        'id' => $addon->category->id,
                        'name' => $addon->category->name,
                    ] : null
                ];
            });
        
        return response()->json([
            'addons' => $addons,
            'total' => count($addons)
        ]);
    }
}
