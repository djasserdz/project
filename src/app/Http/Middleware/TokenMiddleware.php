<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\User;

class TokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('Authorization');
        if (!$header || !str_starts_with($header, 'Bearer ')) {
            return response()->json(['message' => 'Missing or invalid Bearer token'], 401);
        }

        $token = substr($header, 7);
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json(['message' => 'Token not found or invalid'], 401);
        }

        $user = $accessToken->tokenable;
        if (!$user || !($user instanceof User)) {
            return response()->json(['message' => 'Token does not belong to a valid user'], 401);
        }

        $request->setUserResolver(fn () => $user);
        return $next($request);
    }
}