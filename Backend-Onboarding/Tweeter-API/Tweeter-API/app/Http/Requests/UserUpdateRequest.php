<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        $user = $this->route('user');
        return $user->id == auth()->user()->id;
    }

    public function rules()
    {
        return [
            'name' => 'string',
            'email' => 'string|unique:users,email',
            'password' => 'string|confirmed',
        ];
    }
}
