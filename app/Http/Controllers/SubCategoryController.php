<?php

namespace App\Http\Controllers;

use App\Traits\ImageTrait;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Traits\ResponseTrait;
use App\Http\Resources\SubCategoryResourcs;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{
    use ResponseTrait, ImageTrait;   // this calss has a observer
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::all();
        return $this->successResponse('all sub-categories get successfully', 'sub-categories', SubCategoryResourcs::collection($subCategories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $image = null;
        if ($request->has('image'))
            $image =  $this->saveImage('sub-category-images', $request->image);

        $validatedData = $request->validated();
        $validatedData['image'] = $image;
        $subCategory = SubCategory::create($validatedData);
        return $this->successResponse('sub-category created successfully', 'sub-category', new SubCategoryResourcs($subCategory));
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        return $this->successResponse('sub-categories get successfully', 'sub-category', new SubCategoryResourcs($subCategory));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        $subCategory->update($request->validated());
        return $this->successResponse('sub-category updated successfully', 'sub-category', new SubCategoryResourcs($subCategory));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory) //this function has observer
    {
        $subCategory->delete();
        return $this->deletedResponse('sub-category deleted successfully');
    }
}
