<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'size',
        'sub_category_id',
        'main_category_id',
        'vendor_id',
        'brand_id',
    ];



    //geters && setters 
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) =>  env('APP_URL') . '/uploads/' . $image
        );
    }




    //relations

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function mainCategory(): BelongsTo
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id', 'id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }
}
