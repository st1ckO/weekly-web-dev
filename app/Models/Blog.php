<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    // public $timestamps = false

    use SoftDeletes;

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function status() {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
