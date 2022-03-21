<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => 'string',
            'email' => 'string|unique:users,email',
            'password' => 'string|confirmed',
            'image' => 'nullable',
        ];
    }
}
