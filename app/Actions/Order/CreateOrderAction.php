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
            // 1. Calculate total order price
            $totalPrice = collect($data['items'])->sum(function ($item) {
                return (float) $item['quantity'] * (float) $item['unit_price'];
            });

            // 2. Create the Order (OrderObserver automatically generates order_number and defaults)
            $order = Order::create([
                'user_id' => $userId ?? 1,
                'order_type' => $data['order_type'] ?? 'delivery',
                'table_number' => $data['table_number'] ?? null,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // 3. Group and prepare order items (merge identical customizations)
            $groupedItems = [];
            foreach ($data['items'] as $item) {
                $key = $item['menuitem_id'] . '_' . ($item['special_instructions'] ?? '');
                if (isset($groupedItems[$key])) {
                    $groupedItems[$key]['quantity'] += (int) $item['quantity'];
                } else {
                    $groupedItems[$key] = [
                        'menuitem_id' => (int) $item['menuitem_id'],
                        'quantity' => (int) $item['quantity'],
                        'unit_price' => (float) $item['unit_price'],
                        'total_price' => (float) $item['quantity'] * (float) $item['unit_price'],
                        'special_instructions' => $item['special_instructions'] ?? null,
                    ];
                }
            }

            $orderItems = [];
            foreach ($groupedItems as $itemData) {
                $orderItems[] = new OrderItem($itemData);
            }

            // 4. Save items associated with order
            $order->items()->saveMany($orderItems);

            return $order->load(['items.menuItem']);
        });
    }
}
