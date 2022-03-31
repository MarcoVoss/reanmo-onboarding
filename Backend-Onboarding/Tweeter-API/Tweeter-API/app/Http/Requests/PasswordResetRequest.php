<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordResetRequest extends FormRequest
{
    public function rules()
    {
        return [
            'current' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],        ];
    }
}
