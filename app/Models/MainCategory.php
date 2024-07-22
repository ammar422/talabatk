<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}