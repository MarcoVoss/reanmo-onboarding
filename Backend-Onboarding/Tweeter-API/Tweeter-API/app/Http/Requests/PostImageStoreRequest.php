<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostImageStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'image' => 'required|image|file'
        ];
    }
}