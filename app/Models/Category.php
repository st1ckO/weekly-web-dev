<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

class Category extends Model
{
    public function blog() {
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}
