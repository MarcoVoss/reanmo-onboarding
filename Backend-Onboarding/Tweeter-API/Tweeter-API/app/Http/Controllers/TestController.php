<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:viewAny,App\Test')->only('index');
        $this->middleware('can:create,App\Test')->only('store');
        $this->middleware('can:view,test')->only('show');
        $this->middleware('can:update,test')->only('update');
        $this->middleware('can:delete,test')->only('delete');
    }

    public function index()
    {

        //
    }
    public function store(Request $request)
    {

        //
    }
    public function show(Test $test)
    {

        //
    }
    public function update(TestRequest $request, Test $test)
    {
        Log::info(4);
        //
    }
    public function destroy(Test $test)
    {
        //
    }
}
