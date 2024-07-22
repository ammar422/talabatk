<?php

namespace App\Rules;

use App\Models\SubCategory;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class MainCategoryExists implements Rule
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

        return $subCategory->mainCategory && $subCategory->mainCategory->id == $value;
    }
    public function message()
    {
        return 'The selected main category Not linked and does not contain those selected sub-category.';
    }
}
