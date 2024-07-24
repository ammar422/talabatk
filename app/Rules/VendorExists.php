<?php

namespace App\Rules;

use App\Models\SubCategory;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class VendorExists implements Rule
{
    protected $sub_category_id;

    public function __construct($sub_category_id)
    {
        $this->sub_category_id = $sub_category_id;
    }

    public function passes($attribute, $value)
    {
        $subCategory = SubCategory::find($this->sub_category_id);
        if (!$subCategory)
            return false;

            return $subCategory->vendor()->where('id', $value)->exists();
        }

    public function message()
    {
        return 'The selected vendor is Not linked and does not contain those selected sub-category.';
    }
}
