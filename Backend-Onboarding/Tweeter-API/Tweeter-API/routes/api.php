<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostLikesController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ImageController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get("/images/{image}", [ImageController::class, 'show']);
Route::post("/images", [ImageController::class, 'store']);
Route::put("/images/{image}", [ImageController::class, 'update']);
Route::delete("/images/{image}", [ImageController::class, 'destroy']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get("/followers", [FollowersController::class, 'index']);
    Route::post("/followers", [FollowersController::class, 'store']);
    Route::delete("/followers/{follower}", [FollowersController::class, 'destroy']);

    Route::get("/posts/{post}", [PostsController::class, 'show']);
    Route::get("/posts", [PostsController::class, 'index']);
    Route::post("/posts", [PostsController::class, 'store']);
    Route::put("/posts/{post}", [PostsController::class, 'update']);
    Route::delete("/posts/{post}", [PostsController::class, 'destroy']);

    Route::get("/comments/{comment}", [CommentsController::class, 'show']);
    Route::get("/comments", [CommentsController::class, 'index']);
    Route::post("/comments", [CommentsController::class, 'store']);
    Route::put("/comments/{comment}", [CommentsController::class, 'update']);
    Route::delete("/comments/{comment}", [CommentsController::class, 'destroy']);

    Route::get("/news", [NewsController::class, "index"]);
    Route::get("/news/{post}", [NewsController::class, "show"]);

    Route::delete("/post-likes/{id}", [PostLikesController::class, "destroy"]);
    Route::get('/post-likes', [PostLikesController::class, "index"]);
    Route::post("/post-likes", [PostLikesController::class, "store"]);

    Route::delete("/comment-likes/{id}", [CommentLikesController::class, "destroy"]);
    Route::get('/comment-likes', [CommentLikesController::class, "index"]);
    Route::post("/comment-likes", [CommentLikesController::class, "store"]);

    Route::get('/profiles/search', [ProfilesController::class, 'search']);
    Route::get("/profiles", [ProfilesController::class, 'index']);
    Route::get("/profiles/{user}", [ProfilesController::class, 'show']);
    Route::delete("/profiles", [ProfilesController::class, 'destroy']);

    Route::get('/profile', [ProfilesController::class, 'showMe']);
    Route::Put('/profile/{id}', [ProfilesController::class, 'update']);
});
