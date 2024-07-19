<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function successResponse($messgae, $flag = 'data', $data = null, $code = 200,): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $messgae,
            $flag => $data
        ], $code);
    }

    public function faildResponse($messgae, $code): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $messgae
        ], $code);
    }

    public function deletedResponse($messgae, $code=202): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $messgae
        ], $code);
    }
}
