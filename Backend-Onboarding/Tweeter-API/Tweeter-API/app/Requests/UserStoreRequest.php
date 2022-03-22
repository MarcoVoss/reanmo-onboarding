<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email|email',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|confirmed',
            'image' => 'nullable',
        ];
    }
}
