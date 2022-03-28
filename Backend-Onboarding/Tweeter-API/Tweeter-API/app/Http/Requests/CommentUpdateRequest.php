<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'message' => 'required|string',
        ];
    }
}
