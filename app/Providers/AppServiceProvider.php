<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\DeliveryBoy;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Vendor;
use App\Observers\BrandImageObserver;
use App\Observers\BrandObserver;
use App\Observers\DeliveryBoyImageObserver;
use App\Observers\DeliveryBoyObserver;
use App\Observers\ProductObserver;
use App\Observers\SubCategoryImageObserver;
use App\Observers\SubCategoryObserver;
use App\Observers\VendorObserver;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        SubCategory::observe(SubCategoryObserver::class);
        SubCategory::observe(SubCategoryImageObserver::class);
        Product::observe(ProductObserver::class);
        DeliveryBoy::observe(DeliveryBoyObserver::class);
        DeliveryBoy::observe(DeliveryBoyImageObserver::class);
        Vendor::observe(VendorObserver::class);
        Brand::observe(BrandObserver::class);
     

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
