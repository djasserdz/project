<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginReq;
use App\Http\Requests\RegisterReq;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterReq $registerReq)
    {
        $user = AuthService::register($registerReq->validated());

        return $user;
    }

    public function login(LoginReq $loginReq)
    {
        $result = AuthService::login($loginReq->only('email', 'password'));

        return response()->json([
            'token' => $result['token'],
            'user' => new UserResource($result['user']),
        ], Response::HTTP_OK);
    }
}
