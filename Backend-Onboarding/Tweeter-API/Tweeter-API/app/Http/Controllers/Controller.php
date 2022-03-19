<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function notFoundException() {
        return response('Not found!', 404);
    }

    protected function forbiddenAccess() {
        return response('Not yours!', 403);
    }

    protected function failedException() {
        return response('That did not work!', 500);
    }

    protected function success($nr = 200) {
        return response('OK', $nr);
    }

    protected function currentUserId() {
        return auth()->user()->id;
    }
}
