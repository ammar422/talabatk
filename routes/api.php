<?php

use App\Http\Controllers\MainCategoryController;
use Illuminate\Support\Facades\Route;

route::prefix('v1')->group(function () {



    // Authenticated user (customer) routes 'has role:customer'
    route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
        route::get('mainCategory', [MainCategoryController::class, 'index'])->name('mainCategory.index');
        route::get('mainCategory/{mainCategory}', [MainCategoryController::class, 'show'])->name('mainCategory.show');
    });



    // Authenticated user (admin) routes 'has role:admin'
    route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        route::post('mainCategory', [MainCategoryController::class, 'store'])->name('mainCategory.store');
        route::put('mainCategory/{mainCategory}', [MainCategoryController::class, 'update'])->name('mainCategory.update');
        route::delete('mainCategory/{mainCategory}', [MainCategoryController::class, 'destroy'])->name('mainCategory.destroy');
    });


    require __DIR__ . '/auth.php';
});
