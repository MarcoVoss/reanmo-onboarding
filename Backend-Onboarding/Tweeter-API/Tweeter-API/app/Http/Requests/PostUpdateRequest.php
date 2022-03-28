<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'message' => 'required|string',
            'image_id' => 'int'
        ];
    }
}
