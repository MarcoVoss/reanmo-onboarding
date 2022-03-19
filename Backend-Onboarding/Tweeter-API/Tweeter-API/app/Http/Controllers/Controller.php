<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $NAME = 'Base-Controller';

    protected function __construct($name) {
        $this->NAME = $name;
    }

    protected function notFoundException() {
        return response("$this->NAME not found!", 404);
    }

    protected function forbiddenAccess() {
        return response("$this->NAME is not yours!", 403);
    }

    protected function failedException() {
        return response("$this->NAME did not work!", 500);
    }

    protected function success($nr = 200) {
        return response('OK', $nr);
    }

    protected function currentUserId() {
        return auth()->user()->id;
    }
}
