<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token' =>'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'token.required' => 'Token is Required',
            'password.required' => 'Password is Required',
            'password_confirmation.required' => 'Confirm Password is Required',
            'password_confirmation.same' => 'Confirm Password is not Match',
        ];
    }
}
