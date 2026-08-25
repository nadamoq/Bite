<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Str;

class OrderObserver
{
    /**
     * Handle the Order "creating" event.
     */
    public function creating(Order $order): void
    {
        if (empty($order->order_number)) {
            $order->order_number = 'ORD-' . strtoupper(Str::random(6));
        }

        if (empty($order->status)) {
            $order->status = 'pending';
        }

        if (empty($order->order_type)) {
            $order->order_type = 'delivery';
        }
    }
}
