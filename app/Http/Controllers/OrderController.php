<?php

namespace App\Http\Controllers;

use App\Actions\Order\CreateOrderAction;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Addon;
use App\Models\MenuItems;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     */
    public function store(StoreOrderRequest $request, CreateOrderAction $createOrderAction): JsonResponse
    {
        $order = $createOrderAction->execute(
            data: $request->validated(),
            userId: $request->user()?->id
        );

        return response()->json([
            'message' => 'success',
            'data' => $order,
        ], 201);
    }
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'order_type' => 'required|string',
    //         'promo_code' => 'nullable|string',
    //         'items' => 'required|array|min:1',
    //         'items.*.menuitem_id' => 'required|exists:menu_items,id',
    //         'items.*.quantity' => 'required|integer|min:1',
    //         'items.*.special_instructions' => 'nullable|string',
    //         'items.*.addon_ids' => 'nullable|array',
    //         'items.*.addon_ids.*' => 'exists:addons,id',
    //     ]);

    //     return DB::transaction(function () use ($validated, $request) {
    //          $menuItemIds = collect($validated['items'])->pluck('menuitem_id')->unique();
    //         $menuItems = MenuItems::whereIn('id', $menuItemIds)->get()->keyBy('id');

    //         $allAddonIds = collect($validated['items'])->pluck('addon_ids')->flatten()->filter()->unique();
    //         $addons = Addon::whereIn('id', $allAddonIds)->get()->keyBy('id');

    //         $subtotal = 0;
    //         $orderItemsData = [];

    //         foreach ($validated['items'] as $item) {
    //             $menuItem = $menuItems->get($item['menuitem_id']);

    //             $itemUnitPrice = (float) $menuItem->price;
    //             $addonsTotalPrice = 0;
    //             if (!empty($item['addon_ids'])) {
    //                 foreach ($item['addon_ids'] as $addonId) {
    //                     if ($addon = $addons->get($addonId)) {
    //                         $addonsTotalPrice += (float) $addon->price;
    //                     }
    //                 }
    //             }

    //             $totalItemUnitPrice = $itemUnitPrice + $addonsTotalPrice;
    //             $lineTotal = $totalItemUnitPrice * $item['quantity'];
    //             $subtotal += $lineTotal;

    //             $orderItemsData[] = [
    //                 'menuitem_id' => $menuItem->id,
    //                 'quantity' => $item['quantity'],
    //                 'unit_price' => $itemUnitPrice,

    //                 'special_instructions' => $item['special_instructions'],
    //                 'addon_ids' => json_encode($item['addon_ids'] ?? []),
    //             ];
    //         }


    //         $discount = 0;
    //         if (strtoupper($validated['promo_code'] ?? '') === 'CRAVE10') {
    //             $discount = $subtotal * 0.10;
    //         }

    //         $deliveryFee = ($subtotal > 35 || $subtotal === 0) ? 0 : 3.50;
    //         $finalTotal = max(0, $subtotal - $discount + $deliveryFee);

    //         $order = Order::create([
    //             'order_number' => 'ORD-' . strtoupper(Str::random(6)),
    //             'user_id' => auth()->id() ?? null,
    //             'total_price' => $finalTotal,
    //             'order_type' => $validated['order_type'],
    //         ]);

    //         foreach ($orderItemsData as $itemData) {
    //             $order->items()->create($itemData);
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Order placed successfully',
    //             'data' => $order->load('items')
    //         ], 201);
    //     });
    // }
}
