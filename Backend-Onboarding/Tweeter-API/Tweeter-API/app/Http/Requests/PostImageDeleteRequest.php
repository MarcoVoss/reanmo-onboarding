<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostImageDeleteRequest extends FormRequest
{
    public function authorize()
    {
        $post = $this->route('post');
        return $post->user_id == auth()->user()->id;
    }

    public function rules()
    {
        return [];
    }
}
