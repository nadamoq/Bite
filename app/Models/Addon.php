<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Addon extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'description'];

  
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'addon_category_id',
        'is_active',
    ];

    protected $casts = [
        'price' => 'float',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(AddonCategory::class, 'addon_category_id');
    }

    public function activeCategory(): BelongsTo
    {
        return $this->category()->where('is_active', true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('addon_category_id', $categoryId);
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $image = $attributes['image'] ?? null;

                if (empty($image)) {
                    return 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=200&q=80';
                }

                if (Str::startsWith($image, ['http://', 'https://'])) {
                    return $image;
                }

                return Storage::disk('public')->url($image);
            }
        );
    }
}
