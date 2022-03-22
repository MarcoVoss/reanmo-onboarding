<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $NAME = 'Base-Controller';

    protected function __construct($name) {
        $this->NAME = $name;
    }

    protected function notFoundException() {
        return $this->exceptionResponse("$this->NAME not found!", 404);
    }

    protected function forbiddenAccess() {
        return $this->exceptionResponse("$this->NAME is not yours!", 403);
    }

    protected function failedException() {
        return $this->exceptionResponse("$this->NAME did not work!", 500);
    }

    protected function success($obj, $nr = 200) {
        return response($obj, $nr);
    }

    private function exceptionResponse($message, $nr) {
        Log::error($message);
        return response($message, $nr);
    }

    protected function currentUserId() {
        return auth()->user()->id;
    }
}
