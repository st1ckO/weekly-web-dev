<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Status;
use App\Models\Tag;

class Blog extends Model
{
    // public $timestamps = false

    use SoftDeletes;

    public function category() {
        return $this->hasOne(Category::class, "id", "category_id");
    }

    public function status() {
        return $this->hasOne(Status::class, "id", "status_id");
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
