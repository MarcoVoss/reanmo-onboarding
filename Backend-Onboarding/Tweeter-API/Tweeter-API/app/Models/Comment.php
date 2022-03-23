<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'post_id'
    ];

    public static function byUser($id)
    {
        return Comment::all()
            ->where('user_id', $id);
    }

    public static function all($columns = ['*'])
    {
        return Comment::with(['user', 'post']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'comment_users', 'comment_id', 'user_id');
    }
}
