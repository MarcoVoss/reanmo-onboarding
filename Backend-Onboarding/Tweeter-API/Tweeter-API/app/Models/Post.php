<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'image_id'
    ];

    public static function getByUser($id) {
        return Post::with(['user', 'comments'])
            ->where('user_id', $id)
            ->get();
    }

    public static function getByFollows($id) {
        return Post::with(['user', 'comments'])
            ->whereExists(function ($query) use ($id){
                $query->select('followers.user_id')
                    ->from('followers')
                    ->whereRaw("followers.follower_id = $id and followers.user_id = posts.user_id");
        })->get();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function image() {
        return $this->belongsTo(Image::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'post_users', 'post_id', 'user_id');
    }
}
