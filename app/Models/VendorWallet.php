<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorWallet extends Model
{
    use HasFactory;
    protected $fillable =[
        'vendor_id' ,
        'balance'
    ];

    public function vendor():BelongsTo{
        return $this->belongsTo(Vendor::class , 'vendor_id' , 'id');
    }
}
