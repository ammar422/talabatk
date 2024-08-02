<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Traits\ImageTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Resources\BrandResource;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    use ResponseTrait, ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('mainCategory')->paginate(10);
        return $this->successResponse('all brands get successfully', 'brands', $brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request) //has observer 
    {
        $brand = Brand::create($request->validated());
        $brand->mainCategory()->attach($request->main_category_ids);
        return $this->successResponse('brand created successfully', 'brand', new BrandResource($brand));
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return $this->successResponse('the brand get successfully', 'brand', new BrandResource($brand));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        $brand->mainCategory()->attach($request->main_category_ids);
        return $this->successResponse('barnd updated successfully', 'brand', new BrandResource($brand));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand) //has observer
    {
        $brand->delete();
        return $this->deletedResponse('brand deleted successfully');
    }



    public function updateImage(Brand $brand, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails())
            return $this->faildResponse($validator->errors(), 422);
        unlink(base_path() . Str::after($brand->image, env('APP_NAME')));
        $image = $this->saveImage('brand-images', $request->image);
        $brand->update([
            'image' => $image
        ]);
        return $this->successResponse('brand image updated successfully', 'brand', new BrandResource($brand));
    }
}
