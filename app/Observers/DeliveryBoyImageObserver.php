<?php

namespace App\Observers;

use App\Traits\ImageTrait;
use App\Models\DeliveryBoy;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Validator;

class DeliveryBoyImageObserver
{
    use ResponseTrait, ImageTrait;

    public function changeImage(DeliveryBoy $deliveryBoy, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required', 'image', 'mimes:png,jpg,jpeg',
        ]);
        if ($validator->fails())
            return $this->faildResponse($validator->errors(), 422);

        $image = Str::after($deliveryBoy->image, env('APP_NAME'));
        unlink(base_path() . $image);

        $image = $this->saveImage('delivery-boy-images', $request->image);
        $deliveryBoy->update([
            'image' => $image
        ]);
    }
}
