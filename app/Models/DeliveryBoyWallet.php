<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryBoyWallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'deliveryBoy_id',
        'balance',
    ];


    public function deliveryBoy(): BelongsTo
    {
        return $this->belongsTo(DeliveryBoy::class, 'deliveryBoy_id', 'id');
    }

}
