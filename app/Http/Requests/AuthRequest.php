<?php

namespace App\Http\Requests;

class AuthRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        $message = [
            'email.required' => 'email必须填写',
            'password.required' => 'password必须填写'
        ];
        return $message;
    }
}
