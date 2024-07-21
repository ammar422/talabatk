<?php

namespace App\Observers;

use App\Models\SubCategory;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class SubCategoryObserver
{
    /**
     * Handle the SubCategory "created" event.
     */
    public function created(SubCategory $subCategory): void
    {
        //
    }

    /**
     * Handle the SubCategory "updated" event.
     */
    public function updated(SubCategory $subCategory): void
    {
        //
    }

    /**
     * Handle the SubCategory "deleted" event.
     */
    public function deleted(SubCategory $subCategory): void
    {
        try {

            $image = Str::after($subCategory->image, 'talabatk');
            unlink(base_path() .  $image);
        } catch (\Exception $e) {
            // $e->getMessage();
        }
    }

    /**
     * Handle the SubCategory "restored" event.
     */
    public function restored(SubCategory $subCategory): void
    {
        //
    }

    /**
     * Handle the SubCategory "force deleted" event.
     */
    public function forceDeleted(SubCategory $subCategory): void
    {
        //
    }
}
