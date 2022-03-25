<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
            'email' => 'email|unique:users,email',
            'password' => Password::defaults(),
            'image_id' => 'int'
        ];
    }
}
