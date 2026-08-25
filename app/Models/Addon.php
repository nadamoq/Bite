<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Addon extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'addon_category_id',
        'is_active'

    ];
    public function category()
    {
        return $this->belongsTo(AddonCategory::class, 'addon_category_id');
    }
    public function activeCategory()
    {
        return $this->category()->where('is_active', true);
    }
    public function image(): Attribute
    {
        return Attribute::make(get: function (mixed $value, array $attributes) {

            $image = $attributes['image'] ?? null;


            if (empty($image)) {
                return asset('images/default-avatar.png');
            }

            if (Str::startsWith($image, ['http://', 'https://'])) {
                return $image;
            }

            return Storage::disk('public')->url($image);
        });
    }
}
