<?php

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
    Route::put("/posts/{post}", [PostsController::class, 'update']);
    Route::delete("/posts/{post}", [PostsController::class, 'destroy']);

    Route::get("/posts/{post}/image", [PostImageController::class, 'show']);
    Route::post("/posts/{post}/image", [PostImageController::class, 'store']);
    //Route::put("/posts/{post}/image", [PostImageController::class, 'update']);
    Route::delete("/posts/{post}/image", [PostImageController::class, 'destroy']);

    Route::get("/posts/{post}/comments", [PostCommentsController::class, "index"]);
    Route::post("/posts/{post}/comments", [PostCommentsController::class, 'store']);
    //Route::put("/posts/{post}/comments/{comment}", [PostCommentsController::class, 'update']);
    Route::delete("/posts/{post}/comments/{comment}", [PostCommentsController::class, 'destroy']);

    Route::get("/posts/{post}/likes", [PostLikesController::class, "index"]);
    Route::post("/posts/{post}/likes", [PostLikesController::class, "store"]);
    Route::delete("/posts/{post}/likes", [PostLikesController::class, "destroy"]);

    Route::get("/profiles", [ProfilesController::class, 'index']);
    Route::get("/profiles/{user}", [ProfilesController::class, 'show']);
    Route::delete("/profiles/{user}", [ProfilesController::class, 'destroy']);
    Route::Put('/profiles/{user}', [ProfilesController::class, 'update']);

    Route::get("/profiles/{user}/image", [ProfileImageController::class, 'show']);
    Route::delete("/profiles/{user}/image", [ProfileImageController::class, 'destroy']);
    Route::Put('/profiles/{user}/image', [ProfileImageController::class, 'update']);

    Route::get('/profiles/search', [ProfileUtilsController::class, 'search']);
    Route::get("/profiles/{user}/news", [ProfileUtilsController::class, "news"]);

    Route::get("/profiles/{user}/followers", [FollowersController::class, "index"]);
    Route::post("/profiles/{user}/followers/{follower}", [FollowersController::class, 'store']);
    Route::delete("/profiles/{user}/followers/{follower}", [FollowersController::class, 'destroy']);

    Route::get("/profiles/{user}/follows", [FollowersController::class, "index"]);
    Route::post("/profiles/{user}/follows", [FollowersController::class, 'store']);
    Route::delete("/profiles/{user}/follows/{follows}", [FollowersController::class, 'destroy']);
});
