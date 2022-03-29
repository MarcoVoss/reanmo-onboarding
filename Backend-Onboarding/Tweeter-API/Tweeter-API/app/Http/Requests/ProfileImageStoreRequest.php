<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileImageStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'image' => 'nullable|image|file'
        ];
    }
}
