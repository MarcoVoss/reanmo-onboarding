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

    public static function getByFollows($id) {
        return Post::with(['user', 'comments'])
            ->whereExists(function ($query) use ($id){
                $query->select('user_users.user_id')
                    ->from('user_users')
                    ->whereRaw("user_users.follower_id = $id and user_users.user_id = posts.user_id");
        })->paginate(15);
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
