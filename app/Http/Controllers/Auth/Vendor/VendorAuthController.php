<?php

namespace App\Http\Controllers\Auth\Vendor;

use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\Vendor\VendorLoginRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorAuthController extends Controller
{
    use ResponseTrait;
    public function login(VendorLoginRequest $request)
    {
        $vendor = Vendor::where('email', $request->email)->first();
        if (!$vendor || !Hash::check($request->password, $vendor->password) || !$vendor->hasRole('vendor'))
            return $this->faildResponse('Invalid credentials', 400);
        $oldTokens = $vendor->tokens();
        if ($oldTokens)
            $oldTokens->delete();
        $token =   $vendor->createToken('vendor-token', ['role:vendor']);
        return response()->json([
            'status' => true,
            'status' => 'loged in successfully',
            'vendor' => $vendor,
            'token' =>  $token->plainTextToken
        ]);
    }


    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->deletedResponse('vendor logedout successfully', 200);
    }
}
