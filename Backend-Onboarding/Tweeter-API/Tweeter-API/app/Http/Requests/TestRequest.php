<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class TestRequest extends FormRequest
{
    public function authorize()
    {
        Log::info(2);
        return true;
    }

    public function rules()
    {
        Log::info(3);
        return [
            //
        ];
    }
}
