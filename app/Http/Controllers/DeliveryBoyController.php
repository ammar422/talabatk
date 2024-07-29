<?php

namespace App\Http\Controllers;

use App\Models\DeliveryBoy;
use App\Http\Requests\StoreDeliveryBoyRequest;
use App\Http\Requests\UpdateDeliveryBoyRequest;
use App\Http\Resources\DelivryBoyResource;
use App\Observers\DeliveryBoyImageObserver;
use App\Traits\ImageTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class DeliveryBoyController extends Controller
{
    use ResponseTrait, ImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryBoys = DeliveryBoy::paginate(10);
        return $this->successResponse('all delivery boys retrived successfully', 'delivery-boys', $deliveryBoys);
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
        return $this->successResponse('the delivery-boy get successfully', 'delivery-boy', new DelivryBoyResource($deliveryBoy));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryBoyRequest $request, DeliveryBoy $deliveryBoy)
    {
        $deliveryBoy->update($request->validated());
        return $this->successResponse('delivery boy updated successfully', 'delivery-boy', $deliveryBoy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryBoy $deliveryBoy) // has observer
    {
        $deliveryBoy->delete();
        return $this->deletedResponse('delivery boy account deleted successfully');
    }


    public function changeImage(DeliveryBoy $deliveryBoy, Request $request)
    {
        $observer = new DeliveryBoyImageObserver();
        $observer->changeImage($deliveryBoy,  $request);
        return $this->successResponse('delevery boy image successfully changed', 'delivery boy', new DelivryBoyResource($deliveryBoy));
    }
}
