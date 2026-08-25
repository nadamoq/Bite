<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AddonCategory extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
    ];
    public function addons()
    {
        return $this->hasMany(Addon::class);
    }
    public function menuitems()
    {
        return $this->belongsToMany(MenuItems::class, 'menu_items_addon_categories','addon_category_id','menu_item_id');
    }
    public function scopeActive(Builder $query){

        return $query->where('is_active',true);

    }
    public function activeAddons()
    {
        return $this->hasMany(Addon::class)->where('is_active', true);
    }
}
