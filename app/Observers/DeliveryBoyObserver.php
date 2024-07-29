<?php

namespace App\Observers;

use App\Models\DeliveryBoy;
use App\Models\DeliveryBoyWallet;
use Illuminate\Support\Str;

class DeliveryBoyObserver
{
    /**
     * Handle the DeliveryBoy "created" event.
     */
    public function created(DeliveryBoy $deliveryBoy): void
    {
        DeliveryBoyWallet::create([
            'deliveryBoy_id' => $deliveryBoy->id,
            'balance' => 0
        ]);
    }

    /**
     * Handle the DeliveryBoy "updated" event.
     */
    public function updated(DeliveryBoy $deliveryBoy): void
    {
        //
    }

    /**
     * Handle the DeliveryBoy "deleted" event.
     */
    public function deleted(DeliveryBoy $deliveryBoy): void
    {
        try {
            $image = Str::after($deliveryBoy->image, env('APP_NAME'));
            unlink(base_path() . $image);

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Handle the DeliveryBoy "restored" event.
     */
    public function restored(DeliveryBoy $deliveryBoy): void
    {
        //
    }

    /**
     * Handle the DeliveryBoy "force deleted" event.
     */
    public function forceDeleted(DeliveryBoy $deliveryBoy): void
    {
        //
    }
}
