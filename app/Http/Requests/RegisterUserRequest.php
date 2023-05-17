<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'c_password' => 'same:password'
        ];
    }
    public function messages(){
        return [
            'first_name.required' => 'First name is requred',
            'last_name.required' => 'Last name is requred',
            'email.required' => 'Email is requred',
            'password.required' => 'Password is requred',
            'c_password.same' => 'Confirm password must be same as Password',
        ];
    }
}
