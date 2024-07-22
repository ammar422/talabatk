<?php

namespace App\Observers;

use App\Traits\ImageTrait;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SubCategoryImageObserver
{
    use ResponseTrait, ImageTrait;


    public function photoChange(SubCategory $subCategory, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg']
        ]);

        if ($validator->fails())
            throw new HttpResponseException($this->faildResponse($validator->errors(), 422));

        $image = Str::after($subCategory->image, 'talabatk');
        unlink(base_path() .  $image);
        
        $image = $this->saveImage('sub-category-images', $request->image);
        $subCategory->update([
            'image' => $image
        ]);
    }
}
