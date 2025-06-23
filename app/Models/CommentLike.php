<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $fillable = ['user_id'];
    
    public function comment() {
        return $this->belongsTo(Comment::class);
    }
}
