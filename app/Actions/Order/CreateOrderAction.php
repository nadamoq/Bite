<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

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
            // 1. حساب السعر الإجمالي للأوردر
            $totalPrice = collect($data['items'])->sum(function ($item) {
                return (float) $item['quantity'] * (float) $item['unit_price'];
            });

            // 2. إنشاء الطلب الأساسي
            $order = Order::create([
                'user_id' => $userId ?? 1,
                'order_type' => $data['order_type'] ?? 'delivery',
                'table_number' => $data['table_number'] ?? null,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // 3. تجميع العناصر مع مراعاة الـ Addons في المفتاح
            $groupedItems = [];
            foreach ($data['items'] as $item) {
                $addonIds = isset($item['addon_ids']) ? (array) $item['addon_ids'] : [];
                sort($addonIds); // ترتيب الأرقام لضمان التطابق عند التجميع

                $key = $item['menuitem_id'] . '_' . ($item['special_instructions'] ?? '') . '_' . implode(',', $addonIds);

                if (isset($groupedItems[$key])) {
                    $groupedItems[$key]['quantity'] += (int) $item['quantity'];
                    $groupedItems[$key]['total_price'] += (float) $item['quantity'] * (float) $item['unit_price'];
                } else {
                    $groupedItems[$key] = [
                        'menuitem_id' => (int) $item['menuitem_id'],
                        'quantity' => (int) $item['quantity'],
                        'unit_price' => (float) $item['unit_price'],
                        'total_price' => (float) $item['quantity'] * (float) $item['unit_price'],
                        'special_instructions' => $item['special_instructions'] ?? null,
                        'addon_ids' => $addonIds,
                    ];
                }
            }

            // 4. حفظ عناصر الطلب وربط الـ Addons في جدول الربط
           foreach ($groupedItems as $itemData) {
    $addonIds = $itemData['addon_ids'];

    // إنشاء العنصر بتمرير الحقول المطلوبة لجدول order_items حصراً
    $orderItem = $order->items()->create([
        'menuitem_id'          => $itemData['menuitem_id'],
        'quantity'             => $itemData['quantity'],
        'unit_price'           => $itemData['unit_price'],
        'special_instructions' => $itemData['special_instructions'],
    ]);

    // ربط الإضافات مع عنصر الطلب
    if (!empty($addonIds) && method_exists($orderItem, 'addons')) {
        $orderItem->addons()->sync($addonIds);
    }
}

            return $order->load(['items.menuItem', 'items.addons']);
        });
    }
}
