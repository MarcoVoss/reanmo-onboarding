<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentLikeStoreRequest extends FormRequest
{
    public function rules() {
        return [
            'comment_id' => 'required'
        ];
    }
}
