<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'image_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilterName($query, String $name) {
        $query->where('name', 'like', "%$name%")
            ->get();
    }

    public static function getByEmail(String $email) {
        return User::where('email', $email)->first();
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function commentLikes() {
        return $this->belongsToMany(Comment::class, 'comment_users', 'user_id', 'comment_id');
    }

    public function postLikes() {
        return $this->belongsToMany(Post::class, 'post_users', 'user_id', 'post_id');
    }

    public function follower() {
        return $this->belongsToMany(User::class, 'user_users', 'user_id', 'follower_id');
    }

    public function followed() {
        return $this->belongsToMany(User::class, 'user_users', 'follower_id', 'user_id');
    }
}
