<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResorce;
use App\Traits\ImageTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseTrait, ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(20);
        return $this->successResponse('all products get successfully', 'products', $products); //dont use product resource becuase the pagination
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        if ($request->has('image'))
            $image = $this->saveImage('product-images', $request->image);
        $validatedData = $request->validated();
        $validatedData['image'] = $image;
        $product = Product::create($validatedData);
        return $this->successResponse('product created successfully', 'product',  new ProductResorce($product));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->successResponse('the product get successfully', 'product', new ProductResorce($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product) 
    {
        $product->update($request->validated());
        return $this->successResponse('product updated successfully', 'product',  new ProductResorce($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) //has opserver
    {
        $product->delete();
        return $this->deletedResponse('product deleted successfully');
    }

    public function changePhoto(Request $request) //has observer
    {
        //
    }
}
