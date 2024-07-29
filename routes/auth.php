<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\Admin\logindAdminController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\DeliveryBoy\LoginDeliveryBoyController;
use App\Http\Controllers\Auth\Vendor\VendorAuthController;

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// admin authentication routes
Route::post('admin/login', [logindAdminController::class, 'login'])
    ->middleware('guest')
    ->name('admin.login');

route::post('admin/logout', [logindAdminController::class, 'destroy'])
    ->middleware(['auth:admin', 'role:admin'])
    ->name('admin.logout');

//vendor authentication routes 
route::post('vendor/login', [VendorAuthController::class, 'login'])
    ->middleware('guest')
    ->name('vendor.login');

route::post('vendor/logout', [VendorAuthController::class, 'destroy'])
    ->middleware(['auth:sanctum', 'role:vendor'])
    ->name('vendor.logout');


// delivery boy authentication routes

route::post('delivery/login', [LoginDeliveryBoyController::class, 'login'])->middleware('guest')->name('delivery-boy.login');

route::post('delivery/logout', [LoginDeliveryBoyController::class, 'logout'])
    ->middleware(['auth:sanctum', 'role:delivery'])
    ->name('delivery-boy.logout');
