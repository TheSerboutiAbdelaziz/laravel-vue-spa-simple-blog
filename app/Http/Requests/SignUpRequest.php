<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'name' => 'bail | required | min:3',
            'email' => 'bail | required | email | unique:users,email',
            'password' => 'bail | required | min:3 | confirmed',
            'password_confirmation' => 'required | min:3' 
        ];
    }
}
