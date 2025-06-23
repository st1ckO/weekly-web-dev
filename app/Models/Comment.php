<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function author() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function likes() {
        return $this->hasMany(CommentLike::class);
    }
    
    public function isLikedByUserId($userId) {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function toggleLikeByUserId($userId){
        $like = $this->likes()->where('user_id', $userId)->first();

        if ($like) {
            CommentLike::where('comment_id', $this->id)
                    ->where('user_id', $userId)
                    ->delete();
        } else {
            $this->likes()->create(['user_id' => $userId]);
        }
    }
}
