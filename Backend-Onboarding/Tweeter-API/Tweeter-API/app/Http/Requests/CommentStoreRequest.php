<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'message' => 'required|string',
            'post_id' => 'required|exists:posts,id'
        ];
    }
}
