<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function rules() {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
