<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AddonCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_multiple',
        'is_active',
    ];

    protected $casts = [
        'is_multiple' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function addons(): HasMany
    {
        return $this->hasMany(Addon::class);
    }

    public function activeAddons(): HasMany
    {
        return $this->hasMany(Addon::class)->where('is_active', true);
    }

    public function menuItems(): BelongsToMany
    {
        return $this->belongsToMany(
            MenuItems::class,
            'menu_items_addon_categories',
            'addon_category_id',
            'menu_item_id'
        );
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
