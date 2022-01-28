<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['nullable', 'email'],
            'cpf' => ['nullable', 'string'],
            'role' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'password_confirmation' => ['required', Password::min(8)],
            'status' => ['required', 'string']
        ];
    }
}
