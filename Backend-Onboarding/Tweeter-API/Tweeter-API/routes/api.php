<?php

use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowedController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\ProfileUtilsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\PostLikesController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostCommentsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get("/posts/{post}", [PostsController::class, 'show']);
    Route::get("/posts", [PostsController::class, 'index']);
    Route::post("/posts", [PostsController::class, 'store']);
    Route::put("/posts/{post}", [PostsController::class, 'update'])->middleware('can:update,post');
    Route::delete("/posts/{post}", [PostsController::class, 'destroy'])->middleware('can:delete,post');

    Route::get("/posts/{post}/image", [PostImageController::class, 'show']);
    Route::post("/posts/{post}/image", [PostImageController::class, 'store']);
    Route::delete("/posts/{post}/image", [PostImageController::class, 'destroy']);
    Route::get("/posts/{post}/comments", [PostCommentsController::class, "index"]);

    Route::post("/comments", [CommentsController::class, 'store']);
    Route::put("/comments/{comment}", [CommentsController::class, 'update']);
    Route::delete("/comments/{comment}", [CommentsController::class, 'destroy']);

    Route::get("/posts/{post}/likes", [PostLikesController::class, "show"]);
    Route::post("/posts/{post}/likes", [PostLikesController::class, "store"]);
    Route::delete("/posts/{post}/likes", [PostLikesController::class, "destroy"]);

    Route::get("/comments/{comment}/likes", [CommentLikesController::class, "show"]);
    Route::post("/comments/{comment}/likes", [CommentLikesController::class, "store"]);
    Route::delete("/comments/{comment}/likes", [CommentLikesController::class, "destroy"]);

    Route::get("/profiles", [ProfilesController::class, 'index']);
    Route::get("/profiles/{user}", [ProfilesController::class, 'show']);
    Route::delete("/profiles/{user}", [ProfilesController::class, 'destroy']);
    Route::Put('/profiles/{user}', [ProfilesController::class, 'update']);

    Route::get("/profiles/{user}/image", [ProfileImageController::class, 'show']);
    Route::delete("/profiles/{user}/image", [ProfileImageController::class, 'destroy']);
    Route::post('/profiles/{user}/image', [ProfileImageController::class, 'store']);

    Route::get('/search/{name}', [ProfileUtilsController::class, 'search']);
    Route::get("/news", [ProfileUtilsController::class, "news"]);

    Route::get("/profiles/{user}/followers", [FollowersController::class, "index"]);
    Route::post("/profiles/{user}/followers/{follower}", [FollowersController::class, 'store']);
    Route::delete("/profiles/{user}/followers/{follower}", [FollowersController::class, 'destroy']);

    Route::get("/profiles/{user}/follows", [FollowedController::class, "index"]);
    Route::post("/profiles/{user}/follows/{follows}", [FollowedController::class, 'store']);
    Route::delete("/profiles/{user}/follows/{follows}", [FollowedController::class, 'destroy']);
});
