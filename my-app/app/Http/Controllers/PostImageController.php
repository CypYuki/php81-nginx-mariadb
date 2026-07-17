<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostImage;
use App\Models\Post;



class PostImageController extends Controller
{
    public function store(Request $request, int $postId)
    {

        // バリデーション
        $request->validate([
            //'post_id'=>'required|integer',
            'images' => 'required|array',
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif', // 画像ファイルのバリデーション
        ]);

        // 該当ファイルを取得
        $images = $request->file('images');
        foreach ($images as $image) {
            $postImage = new PostImage();
            $result = $postImage->SaveImage($image, $postId);
        }


        return redirect()->route('posts.index')->with('success', '画像が保存されました。');
    }
}
