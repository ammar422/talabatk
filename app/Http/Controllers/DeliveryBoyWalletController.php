<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliveryBoyWalletResource;
use App\Models\DeliveryBoyWallet;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DeliveryBoyWalletController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $wallets = DeliveryBoyWallet::paginate(20);
        return $this->successResponse('all deliver boys wallet get succeffuly', 'delivery-boys-wallets', $wallets);
    }



    public function show()
    {
        $wallet = DeliveryBoyWallet::where('deliveryBoy_id', auth('delivery_boy')->id())->first();
        return $this->successResponse('the wallet get successfully', 'wallet', new DeliveryBoyWalletResource($wallet));
    }


    public function update(DeliveryBoyWallet $deliveryBoyWallet, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'balance' => 'required|numeric|min:0',
        ]);

        if ($validator->fails())
            return $this->faildResponse($validator->errors(), 422);
        $deliveryBoyWallet->update($request->all());
        return $this->successResponse('wallet balance updated successfully', 'wallet', new DeliveryBoyWalletResource($deliveryBoyWallet));
    }
}
