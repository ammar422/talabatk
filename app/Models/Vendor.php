<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Vendor extends Model
{
    use HasFactory, HasApiTokens, HasRoles;

    protected $guard_name = 'api';

    protected $fillable = [
        'name',
        'address',
        'email',
        'main_category_id',
        'sub_category_id',
        'password',
        'image',
    ];

    protected $hidden = [
        'password'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }


    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) =>  env('APP_URL') . '/uploads/' . $image
        );
    }



    public function mainCategory(): BelongsTo
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id', 'id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'vendor_id', 'id');
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(VendorWallet::class, 'vendor_id', 'id');
    }
}
