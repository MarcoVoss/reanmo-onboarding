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

    public static function getAllByFollowerId($id) {
        return Follower::with('user')
            ->where('follower_id', $id)
            ->get();
    }

    public static function getFirstByUserAndFollower($uid, $fid) {
        return Follower::getAllByFollowerId($fid)
            ->where('user_id', $uid)
            ->first();
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function follower() {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
