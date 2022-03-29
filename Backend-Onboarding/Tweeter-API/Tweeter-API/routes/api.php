<?php

use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowedController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\ProfileUtilsController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostLikesController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostCommentsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource("/tests", TestController::class);

    Route::get("/posts/{post}", [PostsController::class, 'show']);
    Route::get("/posts", [PostsController::class, 'index']);
    Route::post("/posts", [PostsController::class, 'store']);
    Route::put("/posts/{post}", [PostsController::class, 'update']);
    Route::delete("/posts/{post}", [PostsController::class, 'destroy']);

    Route::get("/posts/{post}/image", [PostImageController::class, 'show']);
    Route::put("/posts/{post}/image", [PostImageController::class, 'update']);
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
    Route::put('/profiles/{user}/image', [ProfileImageController::class, 'update']);

    Route::get('/search/{name}', [ProfileUtilsController::class, 'search']);
    Route::get("/news", [ProfileUtilsController::class, "news"]);

    Route::post("/follows/{follows}", [FollowedController::class, 'store']);
});
