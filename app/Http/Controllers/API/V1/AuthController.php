<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\ResponseController;
use App\Http\Requests\AuthFormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * log in user
     * @param AuthFormRequest $request
     * @return JsonResponse
     */
    public function login(AuthFormRequest $request): JsonResponse
    {
        $token = auth()->attempt($request->safe()->only(['email', 'password']));

        if (!$token) {
            return ResponseController::response(message:'Incorrect details', code: Response::HTTP_UNAUTHORIZED);
        }


        return ResponseController::response(message: 'Logged In', data: ['token' => $token, 'user' => auth()->user()->load('roles')], code:Response::HTTP_OK);
    }
}
