<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class logindAdminController extends Controller
{
    use ResponseTrait;
    public function login(LoginRequest $request)
    {

        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password) || !$admin->hasRole('admin'))
            return $this->faildResponse('The provided credentials are incorrect.', 400);
        $oldTokens = $admin->tokens();
        if ($oldTokens)
            $oldTokens->delete();
        $token = $admin->createToken('admin-token', ['role:admin']);
        return response()->json([
            'status' => true,
            'mesage' => 'admin loged in successfully',
            'admin' => new AdminResource($admin),
            'token' => $token->plainTextToken,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->deletedResponse('admin logedout successfully', 200);
    }
}
