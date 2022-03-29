<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Test;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Policies\TestPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Test::class => TestPolicy::class,
        User::class => UserPolicy::class,
    ];

    private function passwordDefaults()
    {
        return Password::min(8)
            ->mixedCase()
            ->uncompromised()
            ->numbers()
            ->letters()
            ->symbols();
    }

    public function boot()
    {
        $this->registerPolicies();
        Password::defaults($this->passwordDefaults());
    }
}
