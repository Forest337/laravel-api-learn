<?php

use App\Http\Controllers\V1\AuthBase;
use Illuminate\Http\Request;
if (!function_exists('checkToken')) {

    /**
     * @param AuthBase $base
     * @return \Tymon\JWTAuth\JWTAuth
     */
    function checkToken($token)
    {
        $base = new AuthBase(new Request());
        return $base->checkToken($token);
    }
}
