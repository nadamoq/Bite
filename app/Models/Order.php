<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    //
    protected $fillable = [
        'order_number',
        'table_number',
        'order_type',
        'user_id',
        'status',
        'total_price',
    ];
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
  

    public function calculateTotalPrice(): float
    {
        $total = 0;

        foreach ($this->items as $item) {
           
            $itemTotal = ($item->unit_price ?? 0) * ($item->quantity ?? 1);

          
            $addonsTotal = $item->addons->sum('price') * ($item->quantity ?? 1);

            $total += ($itemTotal + $addonsTotal);
        }

        return $total;
    }
}
