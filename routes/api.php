<?php

use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

route::prefix('v1')->group(function () {



    // Authenticated user (customer) routes 'has role:customer'
    route::middleware(['auth:sanctum', 'role:admin|customer'])->group(function () {
        //main-category
        route::get('mainCategory', [MainCategoryController::class, 'index'])->name('mainCategory.index');
        route::get('mainCategory/{mainCategory}', [MainCategoryController::class, 'show'])->name('mainCategory.show');

        //sub-category
        route::get('subCategory', [SubCategoryController::class, 'index'])->name('subCategory.index');
        route::get('subCategory/{subCategory}', [SubCategoryController::class, 'show'])->name('subCategory.show');

        //vendor
        route::get('vendor', [VendorController::class, 'index'])->name('vendor.index');
        route::get('vendor/{vendor}', [VendorController::class, 'show'])->name('vendor.show');

        //products 
        route::get('product', [ProductController::class, 'index'])->name('product.index');
        route::get('product/{product}', [ProductController::class, 'show'])->name('product.show');
    });



    // Authenticated user (admin) routes 'has role:admin'
    route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

        //main-category
        route::post('mainCategory', [MainCategoryController::class, 'store'])->name('mainCategory.store');
        route::put('mainCategory/{mainCategory}', [MainCategoryController::class, 'update'])->name('mainCategory.update');
        route::delete('mainCategory/{mainCategory}', [MainCategoryController::class, 'destroy'])->name('mainCategory.destroy');

        //sub-category 
        route::post('subCategory', [SubCategoryController::class, 'store'])->name('subCategory.store');
        route::put('subCategory/{subCategory}', [subCategoryController::class, 'update'])->name('subCategory.update');
        route::delete('subCategory/{subCategory}', [SubCategoryController::class, 'destroy'])->name('subCategory.destroy');
        route::post('subCategory/{subCategory}', [SubCategoryController::class, 'updateImage'])->name('subCategory.update-image');

        //vendor
        route::post('vendor', [VendorController::class, 'store'])->name('vendor.store');
        route::put('vendor/{vendor}', [VendorController::class, 'update'])->name('vendor.update');
        route::delete('vendor/{vendor}', [VendorController::class, 'destroy'])->name('vendor.destroy');


        //products
        route::post('product', [ProductController::class, 'store'])->name('product.store');
    });




    // Authenticated user (admin) and (vendor) routes 'has role:admin|vendor'
    route::middleware(['auth:sanctum', 'role:admin|vendor'])->group(function () {

        //main-category


        //sub-category 


        //vendor


        //products
        route::put('product/{product}', [ProductController::class, 'update'])->name('product.update');
        route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    });


    require __DIR__ . '/auth.php';
});
