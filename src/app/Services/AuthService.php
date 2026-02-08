<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\repositories\AuthRepo;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
    public static function register(array $data)
    {
        $user = AuthRepo::find_email($data['email']);
        if ($user) {
            return response()->json([
                'message' => 'Cannot Use This Email',
            ], Response::HTTP_UNAUTHORIZED);
        }
        $new_user = AuthRepo::create($data);
        $token = $new_user->createToken('api_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => new UserResource($new_user),
        ], Response::HTTP_CREATED);
    }

    public static function login(array $data)
    {
        $user = AuthRepo::find_email($data['email']);
        if (! $user) {
            throw new NotFoundHttpException('EMail not found');
        }
        if (! Hash::check($data['password'], $user->password)) {
            throw new UnauthorizedHttpException('', 'Invalid credentials');
        }
        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}
