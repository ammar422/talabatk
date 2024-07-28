<?php

namespace App\Http\Controllers\Auth\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Http\Resources\DelivryBoyResource;
use App\Models\DeliveryBoy;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginDeliveryBoyController extends Controller
{
    use ResponseTrait;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'exists:delivery_boys,email'],
            'password' => 'required', 'string',
        ]);
        if ($validator->fails())
            return $this->faildResponse($validator->errors(), 422);

        $deliveryBoy = DeliveryBoy::where('email', $request->email)->first();
        if (!$deliveryBoy || !Hash::check($request->password, $deliveryBoy->password) || !$deliveryBoy->hasRole('delivery'))
            return $this->faildResponse('The provided credentials are incorrect.', 400);

        $oldToken = $deliveryBoy->tokens();
        if ($oldToken)
            $oldToken->delete();

        $token = $deliveryBoy->createToken('delivery-token', ['role:delivery']);
        return response()->json([
            'status' => true,
            'mesage' => 'delivery boy loged in successfully',
            'admin' => new DelivryBoyResource($deliveryBoy),
            'token' => $token->plainTextToken,
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->deletedResponse('delevery boy logedout successfully', 200);
    }
}
