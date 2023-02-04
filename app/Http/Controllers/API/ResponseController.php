<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ResponseController extends Controller
{
    /**
     * API response format
     * @param string $message
     * @param mixed $data
     * @param int $code
     * @return JsonResponse
     */
    public static function response(string $message, int $code, $data = null): JsonResponse
    {
        if ($data) {
            return response()->json([
                        'message' => $message,
                        'data' => $data
                    ], $code);
        }

        return response()->json([
                    'message' => $message,
                ], $code);
    }
}
