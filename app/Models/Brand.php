<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];


    //geters && setters 
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) =>  env('APP_URL') . '/uploads/' . $image
        );
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }


    public function mainCategory(): BelongsToMany
    {
        return $this->belongsToMany(MainCategory::class, 'brand_main_category', 'brand_id', 'main_category_id');
    }
}
