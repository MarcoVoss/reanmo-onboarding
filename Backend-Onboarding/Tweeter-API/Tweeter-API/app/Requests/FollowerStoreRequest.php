<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FollowerStoreRequest extends FormRequest
{
    public function rules() {
        return [
            'follower_id' => 'required'
        ];
    }
}
