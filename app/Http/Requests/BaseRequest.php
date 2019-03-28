<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     */
    public function failedValidation($validator)
    {
        $error = $validator->errors()->all();
        throw new HttpResponseException(response()->json(['message' => $error[0]], 403));
    }
}
