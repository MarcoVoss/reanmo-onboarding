<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'user_id'
    ];

    protected function setKeysForSelectQuery($query)
    {
        return $query
            ->where('follower_id', '=', $this->getAttribute('follower_id'))
            ->where('user_id', '=', $this->getAttribute('user_id'));
    }

    protected function setKeysForSaveQuery($query)
    {
        return $query
            ->where('follower_id', '=', $this->getAttribute('follower_id'))
            ->where('user_id', '=', $this->getAttribute('user_id'));
    }

    public static function getAllByFollowerId($id) {
        return Follower::with('user')
            ->where('follower_id', "=", $id)
            ->get();
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function follower() {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
