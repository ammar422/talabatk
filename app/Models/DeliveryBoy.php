<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class DeliveryBoy extends Model
{
    use HasFactory, HasRoles, HasApiTokens;


    protected $guard_name = 'api';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image'
    ];
    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function image(): Attribute
    {
        return new Attribute(
            get: fn ($image) => base_path() . '/uploads/' . $image
        );
    }


    public function wallet(): HasOne
    {
        return $this->hasOne(DeliveryBoyWallet::class, 'deliveryBoy_id', 'id');
    }
}
