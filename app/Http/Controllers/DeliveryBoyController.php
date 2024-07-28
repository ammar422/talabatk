<?php

namespace App\Http\Controllers;

use App\Models\DeliveryBoy;
use App\Http\Requests\StoreDeliveryBoyRequest;
use App\Http\Requests\UpdateDeliveryBoyRequest;
use App\Http\Resources\DelivryBoyResource;
use App\Traits\ImageTrait;
use App\Traits\ResponseTrait;

use function PHPUnit\Framework\returnSelf;

class DeliveryBoyController extends Controller
{
    use ResponseTrait, ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryBoyRequest $request)
    {
        if ($request->has('image'))
            $image = $this->saveImage('delivery-boy-images', $request->image);
        $data = $request->validated();
        $data['image'] = $image;
        $deliveryBoy = DeliveryBoy::create($data);
        $deliveryBoy->assignRole('delivery');
        return $this->successResponse('delivery boy account created successfully', 'delviry boy', new DelivryBoyResource($deliveryBoy));
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryBoy $deliveryBoy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryBoyRequest $request, DeliveryBoy $deliveryBoy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryBoy $deliveryBoy)
    {
        //
    }
}
