<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('/posts', PostsController::class);

    Route::resource('/comments', CommentsController::class);

    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show']);

    Route::delete('/followers', [FollowersController::class, 'destroy']);
    Route::post('/followers', [FollowersController::class, 'store']);

    Route::delete('/posts/likes', [PostLikesController::class, 'destroy']);
    Route::post('/posts/likes', [PostLikesController::class, 'store']);

    Route::delete('/comments/likes', [CommentLikesController::class, 'destroy']);
    Route::post('/comments/likes', [CommentLikesController::class, 'store']);
});
