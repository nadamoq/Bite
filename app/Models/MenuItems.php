<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuItems extends Model
{
    //
    protected $guarded = [];

    public function category(): BelongsTo
    {

        return $this->belongsTo(Category::class);
    }
    public function activeCategory()
    {

        return $this->category()->where('is_active', true);
    }
    public function addonCategories()
    {
        return $this->belongsToMany(AddonCategory::class, 'menu_items_addon_categories', 'menu_item_id', 'addon_category_id')->where('is_active', true)
            ->with(['activeAddons']);
    }
    public function orders()
    {

        return $this->belongsToMany(Order::class)->using(OrderItem::class);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(

            get: function (mixed $value, array $attributes) {

                $image = $attributes['image'] ?? null;


                if (empty($image)) {
                    return asset('images/default-avatar.png');
                }

                if (Str::startsWith($image, ['http://', 'https://'])) {
                    return $image;
                }

                return Storage::disk('public')->url($image);
            }
        );
    }
}
