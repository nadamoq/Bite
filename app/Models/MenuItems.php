<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuItems extends Model
{
    protected $guarded = [];

    protected $casts = [
        'price' => 'float',
        'is_active' => 'boolean',
    ];

    /**
     * Relationships
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function activeCategory(): BelongsTo
    {
        return $this->category()->where('is_active', true);
    }

    public function addonCategories(): BelongsToMany
    {
        return $this->belongsToMany(
            AddonCategory::class,
            'menu_items_addon_categories',
            'menu_item_id',
            'addon_category_id'
        )
        ->where('is_active', true)
        ->with(['activeAddons']);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->using(OrderItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'menuitem_id');
    }

    /**
     * Scopes
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query
            ->leftJoin('order_items', 'menu_items.id', '=', 'order_items.menuitem_id')
            ->select('menu_items.*')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
            ->groupBy('menu_items.id')
            ->orderByDesc('total_sold')
            ->orderByDesc('price');
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    public function scopeByCategory(Builder $query, mixed $category): Builder
    {
        if (empty($category) || $category === 'all') {
            return $query;
        }

        if (is_numeric($category)) {
            return $query->where('category_id', (int) $category);
        }

        return $query->whereHas('category', function ($q) use ($category) {
            $q->where('slug', $category);
        });
    }

    /**
     * Accessors & Mutators
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $image = $attributes['image'] ?? null;

                if (empty($image)) {
                    return 'https://images.unsplash.com/photo-1568901346715-366b9e2d4f4d?w=600&q=90';
                }

                if (Str::startsWith($image, ['http://', 'https://'])) {
                    return $image;
                }

                return Storage::disk('public')->url($image);
            }
        );
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => '$' . number_format($this->price, 2)
        );
    }

    /**
     * Format Model into structured frontend schema
     */
    public function toFrontendArray(?string $badgeType = null): array
    {
        $badgeStyles = [
            'bestseller' => ['ar' => 'الأكثر مبيعاً', 'en' => 'Bestseller', 'class' => 'bg-green-500/30 text-green-200 backdrop-blur-md'],
            'chef-special' => ['ar' => 'طبق الشيف', 'en' => "Chef's Special", 'class' => 'bg-purple-500/30 text-purple-200 backdrop-blur-md'],
            'crispy-hot' => ['ar' => 'مقرمش وساخن', 'en' => 'Crispy & Hot', 'class' => 'bg-crimson-cta/30 text-crimson-hot backdrop-blur-md'],
            'extra-cheese' => ['ar' => 'جبنة إضافية', 'en' => 'Extra Cheese', 'class' => 'bg-amber-glow/30 text-amber-warm backdrop-blur-md'],
        ];

        $badge = $badgeType && isset($badgeStyles[$badgeType]) ? $badgeStyles[$badgeType] : null;

        return [
            'id' => $this->id,
            'category' => $this->category?->slug ?? 'uncategorized',
            'category_id' => $this->category_id,
            'price' => (float) $this->price,
            'image' => $this->imageUrl,
            'name' => [
                'ar' => $this->name,
                'en' => $this->name,
            ],
            'description' => $this->description,
            'desc' => [
                'ar' => $this->description,
                'en' => $this->description,
            ],
            'rating' => '4.8',
            'badge' => $badge ? ['ar' => $badge['ar'], 'en' => $badge['en']] : null,
            'badgeClass' => $badge ? $badge['class'] : null,
            'badges' => $badgeType ? [$badgeType] : [],
            'addon_categories' => $this->relationLoaded('addonCategories')
                ? $this->addonCategories->map(function ($addonCat) {
                    return [
                        'id' => $addonCat->id,
                        'name' => [
                            'ar' => $addonCat->name,
                            'en' => $addonCat->name,
                        ],
                        'is_multiple' => (bool) $addonCat->is_multiple,
                        'addons' => $addonCat->relationLoaded('activeAddons')
                            ? $addonCat->activeAddons->map(function ($addon) {
                                return [
                                    'id' => $addon->id,
                                    'name' => [
                                        'ar' => $addon->name,
                                        'en' => $addon->name,
                                    ],
                                    'price' => (float) $addon->price,
                                    'image' => $addon->image,
                                ];
                            })->values()->toArray()
                            : [],
                    ];
                })->values()->toArray()
                : [],
        ];
    }
}
