<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function rules() {
        return [
            'message' => 'required|string',
        ];
    }
}