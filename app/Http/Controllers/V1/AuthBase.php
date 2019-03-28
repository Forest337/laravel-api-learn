<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class BaseController
 * @package App\Http\Controllers\V1
 */
class AuthBase
{
    public $token;

    /**
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->token = $request->bearerToken();
        if ($this->token) {
            JWTAuth::setToken($this->token);
        }
    }

    /**
     * 获取Token，如果Token 失效则返回false
     * @return mixed
     */
    public function getToken()
    {
        if (!$this->checkToken()) {
            return false;
        }
        return $this->token;
    }

    /**
     * 检查Token是否可用
     * @return \Tymon\JWTAuth\JWTAuth
     */
    public function checkToken($token = '')
    {
        if ($token) {
            $this->token = $token;
            JWTAuth::setToken($this->token);
        }
        return JWTAuth::check();
    }

    /**
     * 刷新token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken()
    {
        $this->token = JWTAuth::refresh();
        return $this->token;
    }
}
