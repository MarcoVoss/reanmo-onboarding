<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowerStoreRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'follower_id' => 'required'
        ];
    }
}
