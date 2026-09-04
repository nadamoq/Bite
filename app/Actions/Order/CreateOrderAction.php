<?php

namespace App\Actions\Order;

use App\Models\Addon;
use App\Models\MenuItems;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CreateOrderAction
{
    /**
     * Execute the order creation within a secure database transaction.
     *
     * @param array $data Validated order data
     * @param int|null $userId User ID or null
     * @return Order
     */
    public function execute(array $data, ?int $userId = null): Order
    {
       return DB::transaction(function () use ($data, $userId) {

            $menuItemIds = collect($data['items'])->pluck('menuitem_id')->unique();
            $menuItems = MenuItems::whereIn('id', $menuItemIds)->get()->keyBy('id');

            $allAddonIds = collect($data['items'])->pluck('addon_ids')->flatten()->filter()->unique();
            $addons = Addon::whereIn('id', $allAddonIds)->get()->keyBy('id');

            $groupedItems = [];
            $orderTotalPrice = 0;

            // 2. تجميع العناصر مع حساب الأسعار المعتمدة
            foreach ($data['items'] as $item) {
                $menuitemId = (int) $item['menuitem_id'];
                $menuItem = $menuItems->get($menuitemId);

                if (!$menuItem) {
                    throw new InvalidArgumentException("Menu item with ID {$menuitemId} not found.");
                }

                $addonIds = isset($item['addon_ids']) ? (array) $item['addon_ids'] : [];
                sort($addonIds);
                $basePrice = (float) $menuItem->price;
                $addonsPrice = 0;
                foreach ($addonIds as $addonId) {
                    if ($addon = $addons->get($addonId)) {
                        $addonsPrice += (float) $addon->price;
                    }
                }

                $calculatedUnitPrice = $basePrice + $addonsPrice;
                $quantity = (int) $item['quantity'];
                $instructions = $item['special_instructions'] ?? null;

                $key = $menuitemId . '_' . ($instructions ?? '') . '_' . implode(',', $addonIds);

                if (isset($groupedItems[$key])) {
                    $groupedItems[$key]['quantity'] += $quantity;
                } else {
                    $groupedItems[$key] = [
                        'menuitem_id'          => $menuitemId, // مفتاح مضمون ونظيف
                        'quantity'             => $quantity,
                        'unit_price'           => $calculatedUnitPrice,
                        'special_instructions' => $instructions,
                        'addon_ids'            => $addonIds,
                    ];
                }

                $orderTotalPrice += ($calculatedUnitPrice * $quantity);
            }

            // 3. إنشاء الأوردر الرئيسي
            $order = Order::create([
                'user_id'      => $userId ?? 1,
                'order_type'   => $data['order_type'] ?? 'delivery',
                'table_number' => $data['table_number'] ?? null,
                'total_price'  => $orderTotalPrice,
                'status'       => 'pending',
            ]);

            // 4. إدخال العناصر وربط الـ Pivot Table للإضافات
            foreach ($groupedItems as $itemData) {
                $orderItem = $order->items()->create([
                    'menuitem_id'          => $itemData['menuitem_id'],
                    'quantity'             => $itemData['quantity'],
                    'unit_price'           => $itemData['unit_price'],
                    'special_instructions' => $itemData['special_instructions'],
                ]);

                if (!empty($itemData['addon_ids']) && method_exists($orderItem, 'addons')) {
                    $orderItem->addons()->sync($itemData['addon_ids']);
                }
            }

            return $order->load(['items.menuItem', 'items.addons']);
        });
    }
}