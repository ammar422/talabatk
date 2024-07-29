<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) =>  env('APP_URL') . '/uploads/' . $image
        );
    }

    public function subCategory(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'main_category_id', 'id');
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'main_category_id', 'id');
    }
}
