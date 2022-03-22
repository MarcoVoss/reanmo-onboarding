<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentLikeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'comment_id' => 'required'
        ];
    }
}
