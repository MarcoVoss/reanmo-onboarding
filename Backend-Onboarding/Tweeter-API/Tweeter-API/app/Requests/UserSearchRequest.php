<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSearchRequest extends FormRequest
{
    public function rules() {
        return [
            'name' => 'string|nullable'
        ];
    }
}
