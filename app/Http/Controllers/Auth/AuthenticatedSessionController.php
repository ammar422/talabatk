<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    protected function response($message, $code)
    {
        return   response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $user = $request->user();
        if ($user == null || $user->count() < 0)
            throw new HttpResponseException($this->response('user not found', 400));
        $user->tokens()->delete();
        $token = $user->createToken('cutomer-token', ['role:customer']);
        return response()->json([
            'status' => true,
            'mesage' => 'user loged in successfully',
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
