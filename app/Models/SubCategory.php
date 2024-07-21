<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'main_category_id'
    ];



    //geters && setters 
    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($image) => base_path() . '/uploads/' . $image
        );
    }




    //relations
    public function mainCategory(): BelongsTo
    {
        return $this->belongsTo(MainCategory::class, 'main_category_id', 'id');
    }
}
