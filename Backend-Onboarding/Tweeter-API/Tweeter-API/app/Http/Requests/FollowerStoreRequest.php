<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FollowerStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'follower_id' => [
                'required',
                Rule::notIn([auth()->user()->id]),
            ]
        ];
    }
}
