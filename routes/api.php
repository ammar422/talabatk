<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryBoyController;
use App\Http\Controllers\DeliveryBoyWalletController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorWalletController;
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

        //cart
        route::get('cart', [CartController::class, 'index'])->name('cart.index');
        route::get('cart/{cart}', [CartController::class, 'show'])->name('cart.show');
        route::post('cart', [CartController::class, 'store'])->name('cart.store');
        route::put('cart/{cart}', [CartController::class, 'update'])->name('cart.update');
        route::delete('cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
        route::delete('cart_delete_all', [CartController::class, 'deleteAll'])->name('cart.deleteAll');

        //checkout
        route::post('checkout', CheckoutController::class)->name('order.checkout');

        //brand
        route::get('brand', [BrandController::class, 'index'])->name('brand.index');
        route::get('brand/{brand}', [BrandController::class, 'show'])->name('brand.show');
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

        //delevery boy
        route::get('delivery_boy', [DeliveryBoyController::class, 'index'])->name('delivery-boy.index');
        route::get('delivery_boy/{delivery_boy}', [DeliveryBoyController::class, 'show'])->name('delivery-boy.show');
        route::post('delivery_boy/register', [DeliveryBoyController::class, 'store'])->name('delivery-boy.register');
        route::put('delivery_boy/{delivery_boy}', [DeliveryBoyController::class, 'update'])->name('delivery-boy.update');
        route::delete('delivery_boy/{delivery_boy}', [DeliveryBoyController::class, 'destroy'])->name('delivery-boy.destroy');
        route::post('delivery_boy/{delivery_boy}', [DeliveryBoyController::class, 'changeImage'])->name('delivery-boy.changeImage');

        //delivery boy wallet 
        route::get('delivery_boy_wallet/all', [DeliveryBoyWalletController::class, 'index'])->name('delivery-boy-wallet.index');
        route::put('delivery_boy_wallet/{delivery_boy_wallet}', [DeliveryBoyWalletController::class, 'update'])->name('delivery-boy-wallet.update');

        //vendor wallet 
        route::put('vendor_wallet/{vendor_wallet}', [VendorWalletController::class, 'update'])->name('vendor-wallet.update');

        //brand

        route::post('brand', [BrandController::class, 'store'])->name('brand.store');
        route::put('brand/{brand}', [BrandController::class, 'update'])->name('brand.update');
        route::delete('brand/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');
        route::post('brand/{brand}/image', [BrandController::class, 'updateImage'])->name('brand.updateImage');
    });




    // Authenticated user (admin) and (delivery-boy) routes 'has role:admin|delivery'
    route::middleware(['auth:sanctum', 'role:admin|delivery'])->group(function () {

        //main-category


        //sub-category 


        //vendor


        //products


        //delivery boy wallet 
        route::get('delivery_boy_wallet', [DeliveryBoyWalletController::class, 'show'])->name('delivery-boy-wallet.show');
    });








    // Authenticated user (admin) and (vendor) routes 'has role:admin|vendor'
    route::middleware(['auth:sanctum', 'role:admin|vendor'])->group(function () {

        //main-category


        //sub-category 


        //vendor


        //vendor wallet 
        route::get('vendor_wallet/{vendor_wallet}', [VendorWalletController::class, 'show'])->name('vendor-wallet.show');

        //products
        route::put('product/{product}', [ProductController::class, 'update'])->name('product.update');
        route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

        //offer
        Route::post('offer', [OfferController::class, 'store'])->name('offer.store');
        Route::put('offer/{offer}', [OfferController::class, 'update'])->name('offer.update');
        Route::delete('offer/{offer}', [OfferController::class, 'destroy'])->name('offer.destroy');
    });














    // Authenticated user (admin) and (vendor) and (customer) routes 'has role:admin|vendor|customer'
    route::middleware(['auth:sanctum', 'role:admin|vendor|customer'])->group(function () {

        //main-category


        //sub-category 


        //vendor


        //vendor wallet 


        //products


        //offer
        route::get('offer', [OfferController::class, 'index'])->name('offer.index');
        route::get('offer/{offer}', [OfferController::class, 'show'])->name('offer.show');
    });


    require __DIR__ . '/auth.php';
});
