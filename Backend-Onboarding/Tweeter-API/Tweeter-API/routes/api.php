<?php

use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FollowedController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ProfileUtilsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostLikesController;
use App\Http\Controllers\PostCommentsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource("posts", PostsController::class)
        ->except("index");
    Route::get("/posts/{post}/comments", [PostCommentsController::class, "index"]);
    Route::put("/posts/{post}/image", [PostImageController::class, 'update']);
    Route::post("/posts/{post}/like", [PostLikesController::class, "store"]);

    Route::post("/comments/{comment}/like", [CommentLikesController::class, "store"]);
    Route::apiResource("comments", CommentsController::class)
        ->except(['index', 'show']);

    Route::get("/profile/home", [ProfileUtilsController::class, "home"]);
    Route::get("/profile/news", [ProfileUtilsController::class, "news"]);
    Route::post("/profile/follows/{follows}", [FollowedController::class, 'store']);
    Route::put("/profile/image", [ProfileImageController::class, 'update']);

    Route::put("/profile", [ProfilesController::class, "update"]);
    Route::delete("/profile", [ProfilesController::class, "destroy"]);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/search/{name}', [ProfileUtilsController::class, 'search']);
});
