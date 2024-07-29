<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorWalletResource;
use App\Models\VendorWallet;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class VendorWalletController extends Controller
{
    use ResponseTrait;


    /**
     * Display the specified resource.
     */
    public function show(VendorWallet $vendorWallet)
    {
        return $this->successResponse('the vendor wallet get successfully', 'vendor_wallet', new VendorWalletResource($vendorWallet));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VendorWallet $vendorWallet)
    {
        $validator = Validator::make($request->all(), ['balance' => 'required', 'numeric', 'min:0']);
        if ($validator->fails())
            return $this->faildResponse($validator->errors(), 422);

        $vendorWallet->update($request->all());

        return $this->successResponse('the vendor wallet updated successfully', 'vendor_wallet', new VendorWalletResource($vendorWallet));
    }
}
