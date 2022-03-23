<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email|email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'image_id' => 'int'
        ];
    }
}
