<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        // タグと投稿の多対多の関係を定義
        return $this->belongsToMany(Post::class);
    }
}
