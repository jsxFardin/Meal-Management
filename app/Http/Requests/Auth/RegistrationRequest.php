<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|string|max:255',
            'username'          => 'nullable',
            'phone'             => 'nullable|numeric',
            'email'             => 'required|email',
            'roles_id'          => 'required',
            'password'          => 'required|min:6',
            'c_password'        => 'required|min:6',
            'remember_token'    => 'nullable',
        ];
    }
}