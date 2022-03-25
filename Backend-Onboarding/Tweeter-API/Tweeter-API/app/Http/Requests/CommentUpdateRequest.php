<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    public function authorize()
    {
        $comment = $this->route("comment");
        return $comment->user_id == auth()->user()->id;
    }

    public function rules()
    {
        return [
            'message' => 'required|string',
        ];
    }
}
