<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileImageStoreRequest extends FormRequest
{
    public function authorize()
    {
        $user = $this->route('user');
        return $user->id == auth()->user()->id;
    }

    public function rules()
    {
        return [
            'image' => 'required|image|file'
        ];
    }
}
