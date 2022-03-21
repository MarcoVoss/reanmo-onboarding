<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    public function rules() {
        return [
            'message' => 'required|string',
            'id' => 'required'
        ];
    }
}
