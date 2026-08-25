<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\str;
use Override;

class Category extends Model
{
    //
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'is_active',
    ];
    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItems::class);
    }
    #[Override]
    public static function booted()
    {
        return static::creating(function (Category $category) {

            return $category->slug = Str::slug($category->title);

        });
    }
    
       
}
