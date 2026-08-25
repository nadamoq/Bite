<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'table_number',
        'order_type',
        'user_id',
        'status',
        'total_price',
    ];

    protected $casts = [
        'total_price' => 'float',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'completed');
    }

    protected function formattedTotalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => '$' . number_format($this->total_price, 2)
        );
    }

    public function calculateTotalPrice(): float
    {
        $total = 0.0;

        foreach ($this->items as $item) {
            $itemTotal = ($item->unit_price ?? 0) * ($item->quantity ?? 1);
            $addonsTotal = $item->addons ? $item->addons->sum('price') * ($item->quantity ?? 1) : 0;
            $total += ($itemTotal + $addonsTotal);
        }

        return (float) $total;
    }
}
