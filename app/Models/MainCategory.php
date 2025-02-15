<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MainCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

   
    public function subCategory(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'main_category_id', 'id');
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'main_category_id', 'id');
    }

    public function brand():BelongsToMany{
        return $this->belongsToMany(Brand::class , 'brand_main_category' , 'main_category_id' , 'brand_id');
    }
}
