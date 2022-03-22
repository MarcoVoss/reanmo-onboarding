<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        $userId = $this->route('id');
        return $userId == auth()->user()->id;
    }

    public function rules()
    {
        return [
            'name' => 'string',
            'email' => 'string|unique:users,email',
            'password' => 'string|confirmed',
            'image' => 'nullable',
        ];
    }
}
