<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostLikesStoreRequest extends FormRequest
{
    public function rules() {
        return [
            'post_id' => 'required|int'
        ];
    }
}
