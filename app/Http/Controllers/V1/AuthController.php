<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthController
 * @package App\Http\Controllers\V1
 */
class AuthController extends Controller
{
    /**
     * 根据用户账号密码获取Token
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerClient(AuthRequest $request)
    {
        /*
        $credentials = request(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Non-Authoritative Information'], 203);
        }
        */
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token], 200);
    }

    /**
     * 刷新Token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function refreshToken(Request $request, AuthBase $base)
    {
        if (!checkToken($request->bearerToken())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = $base->refreshToken();
        return response()->json(['token' => $token], 200);
    }
}
