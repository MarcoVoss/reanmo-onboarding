<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostLikesStoreRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'post_id' => 'required|int'
        ];
    }
}
