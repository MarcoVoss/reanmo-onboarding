<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function rules() {
        return [
            'post_id' => 'required',
            'message' => 'required|string'
        ];
    }
}
