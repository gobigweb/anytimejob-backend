<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
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
            'name.required' => 'First Name is Required',
            'email.required' => 'Email is Required',
            'email.email' => 'Invalid Email Address',
            'email.unique' => 'Email Address Already Exist',
            'password.required' => 'Password is Required',
            'password_confirmation.required' => 'Confirm Password is Required',
            'password_confirmation.same' => 'Confirm Password is not Match',
        ];
    }
}
