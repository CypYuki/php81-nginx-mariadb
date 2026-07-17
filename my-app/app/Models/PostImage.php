<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PostImage extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'url'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function SaveImage($image, int $postId): PostImage
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('images', $imageName, 'public');

        $postImage = new PostImage();
        $postImage->post_id = $postId;
        $postImage->url = 'images/' . $imageName; // 画像のURLを設定（必要に応じて変更）
        $postImage->save();
        return $postImage;
    }
}
