<?php

namespace App\Models;

use Database\Seeders\TagsTableSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

    // データベースからすべての投稿を取得 (戻り値の型を返す)
    public function createPost($data):Post
    {

        $user_id = 1;

        $post = new Post();
        $post->user_id = $user_id;
        $post->title = $data["title"];
        $post->body = $data["body"];
        $post->created_at = now();
        $post->updated_at = now();
        $post->save();
        return $post;
    }

    // データベースに更新
    public function updatePost($data):Post

    {
        $post = Post::find($data["id"]);

        $post->title = $data["title"];
        $post->body = $data["body"];
        $post->updated_at = now();
        $post->save();

        return $post;
    }

    // データベースから削除
    public function deletePost($id):Post
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $post;
    }

//     // データ取得
//     public function GetPostWithNormalSql()
//     {
//         $posts = DB::select('SELECT * FROM posts');
//        // dd($posts);
//         return $posts;
//     }

//     // データ追加
//     public function createPostWithNormalSql($data)
//     {
//         $user_id = $data->user_id;
//         $title = $data->title;
//         $body = $data->body;
//         $created_at = now();
//         $updated_at = now();

//         DB::insert('INSERT INTO posts (user_id, title, body, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [$user_id, $title, $body, $created_at, $updated_at]);
//   }

//     // データ更新
//     public function updatePostWithNormalSql($data)
//     {
//         $id=$data->id;
//         $user_id = $data->user_id;
//         $title = $data->title;
//         $body = $data->body;
//         $created_at = now();
//         $updated_at = now();

//         DB::update('UPDATE posts SET user_id = ?, title = ?, body = ?, updated_at = ? WHERE id = ?', [$user_id, $title, $body, $updated_at, $id]);
//   }
//   // データ削除
//     public function deletePostWithNormalSql($data)
//     {
//         DB::delete('DELETE FROM posts WHERE id = ?', [$data->id]);
//     }
//     // トランザクションデータ
//     public function createBulkPostWithNormalSql($data)
//     {
//         DB::transaction(function () use ($data) {
//             foreach ($data as $item) {
//                 DB::insert('INSERT INTO posts (user_id, title, body, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [
//                     $item->user_id,
//                     $item->title,
//                     $item->body,
//                     now(),
//                     now()
//                 ]);
//             }
//         });
//         return $this->belongsTo(User::class);
//     }

//     // データ追加
//     public function createPostWithQueryBuilder($data)
//     {
//         $post = DB::table('posts')->insert([
//             'user_id' => $data->user_id,
//             'title' => $data->title,
//             'body' => $data->body,
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);

//         return $post;
//     }

//     // データ更新
//     public function updatePostWithQueryBuilder($data)
//     {
//         $post = DB::table('posts')
//             ->where('id', $data->id)
//             ->update([
//                 'user_id' => $data->user_id,
//                 'title' => $data->title,
//                 'body' => $data->body,
//                 'updated_at' => now(),
//                 'created_at' => now(),
//             ]);

//         return $post;
//     }

//     // データ削除
//     public function deletePostWithQueryBuilder($data)
//     {
//         $post = DB::table('posts')
//             ->where('id', $data->id)
//             ->delete();
//     }

//     // データ取得
//     public function GetPostWithQueryBuilder()
//     {
//         $posts = DB::table('posts')->get();
//         dd($posts);
//         return $posts;
//     }

//     // 特定データの取得
//     public function getPostWithQueryBuilderByFilter()
//     {
//                 //ページネーション
//         $post = DB::table('posts')
//             //->where('title', 'like', '%投稿%') // タイトルに「内容」を含む投稿を取得
//             //->whereIn('id', [1, 2, 3]) // idが1, 2, 3のいずれかである投稿を取得
//             //->orderBy('created_at', 'desc') // 作成日時の降順でソート
//             //->orderBy('id', 'asc') // idの昇順でソート

//             ->paginate(5); // 1ページあたり5件のデータを取得
//         return $post;
//     }

//     // カウント
//     public function getCountPosts()
//     {
//         $count = DB::table('posts')->count();
//         return $count;
//     }

//     // データ連結
//     public function getPostsAndUserWithQueryBuilder()
//     {
//         $posts = DB::table('posts')
//             ->join('users', 'posts.user_id', '=', 'users.id')
//             ->select('posts.*', 'users.name as user_name')
//             ->get();

//         return $posts;
//     }

//     // サブクエリ
//     public function getPostsWithBuilderSubquery()
//     {

//         $posts = DB::table('posts')
//             ->whereIn('id', function ($query) {
//                 $query->select(DB::raw('MAX(id)'))
//                     ->from('posts')
//                     ->groupBy('user_id');
//             })
//             ->toSql(); // SQLクエリを取得
//         return $posts;
//     }

//     // Eloquent利用でデータ取得
//     public function getPostWithEloquent()
//     {
//         //$posts = Post::all();
//         //$posts = Post::with('tag')->get(); // タグの取得
//         //$posts = Post::all();

//         $posts = Post::with(['tags', 'user'])->get(); // タグとユーザーの取得
// /*
//         foreach ($posts as $post) {
//            // $post->tags; // タグの取得
//            $post->tags; // タグの取得
//            $post->user; // ユーザーの取得
//         }
// */

//         $posts = Post::with(['tags' => function ($query) {
//             $query->where('name', 'like', '%赤%'); // タグ名に「タグ」を含むものを取得
//         }])->get();

//         return $posts;
//     }

//     // Eloquent利用でデータFIND
//     public function getPostWithEloquentFind($id)
//     {
//         $post = Post::find($id);
//         return $post;
//     }

//     // Eloquent利用でデータFIND
//     public function getPostWithEloquentById($id)
//     {
// //        $post = Post::onlyTrashed()->find($id);       // ゴミ箱
//         $post = Post::withTrashed()->find($id);
//         //dd($post->tags); // タグの取得
//         return $post;
//     }

//     // Eloquentゴミ箱のみ
//     public function getPostWithEloquentOnlyTrashed()
//     {
//         $post = Post::onlyTrashed()->get();       // ゴミ箱
//         //dd($post->tags); // タグの取得
//         return $post;
//     }

//     // Eloquent利用でデータ追加
//     public function createPostWithEloquent($data)
//     {
//         $post = new Post();
//         $post->user_id = $data->user_id;
//         $post->title = $data->title;
//         $post->body = $data->body;
//         $post->created_at = now();
//         $post->updated_at = now();
//         $post->save();

//         return $post;
//     }

//     // Eloquent利用でデータ更新
//     public function updatePostWithEloquent($data)
//     {
//         $post = Post::find($data->id);
//         if ($post) {
//             $post->user_id = $data->user_id;
//             $post->title = $data->title;
//             $post->body = $data->body;
//             $post->save();
//         }
//         return $post;
//     }
//     // Eloquent利用でデータ削除
//     public function deletePostWithEloquent($id)
//     {
//         $post = Post::find($id);
//         if ($post) {
//             $post->delete();
//         }
//         return $post;
//     }

}
