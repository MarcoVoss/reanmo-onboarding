<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostLikesController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('/followers', FollowersController::class, ['only' => [
        'destroy', 'store', 'index'
    ]]);

    Route::resource('/posts', PostsController::class, ['except' => [
        'create', 'edit'
    ]]);

    Route::resource('/comments', CommentsController::class, ['except' => [
        'create', 'edit'
    ]]);

    Route::resource('/news', NewsController::class, ['only' => [
        'index', 'show'
    ]]);

    Route::resource('/posts/likes', PostLikesController::class, ['only' => [
        'destroy', 'store'
    ]]);

    Route::resource('/comments/likes', CommentLikesController::class, ['only' => [
        'destroy', 'store'
    ]]);
});
