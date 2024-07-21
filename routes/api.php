<?php

use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

route::prefix('v1')->group(function () {



    // Authenticated user (customer) routes 'has role:customer'
    route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
        //main-category
        route::get('mainCategory', [MainCategoryController::class, 'index'])->name('mainCategory.index');
        route::get('mainCategory/{mainCategory}', [MainCategoryController::class, 'show'])->name('mainCategory.show');

        //sub-category
        route::get('subCategory', [SubCategoryController::class, 'index'])->name('subCategory.index');
        route::get('subCategory/{subCategory}', [SubCategoryController::class, 'show'])->name('subCategory.show');
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
    });


    require __DIR__ . '/auth.php';
});
