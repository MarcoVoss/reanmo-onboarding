<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
    ];

    public static function byId($id)
    {
        return Comment::all()
            ->find($id);
    }

    public static function byUser($id)
    {
        return Comment::all()
            ->where('user_id', $id)
            ->get();
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
}
