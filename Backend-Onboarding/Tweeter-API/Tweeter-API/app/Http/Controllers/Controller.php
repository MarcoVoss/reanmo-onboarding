<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $NAME = 'Base-Controller';

    protected function __construct($name) {
        $this->NAME = $name;
    }

    protected function saveImage(UploadedFile $image, $fileName) {
        return $image->storeAs('images', "$fileName.{$image->extension()}", 'public');
    }

    protected function currentUserId() {
        return auth()->user()->id;
    }
}
