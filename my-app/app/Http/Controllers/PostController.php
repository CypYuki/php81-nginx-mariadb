<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PostImageController;

class PostController extends Controller
{
    /*
    * Display a listing of the resource.
    */
    public function index()
    {
         // データを作成
        $posts = Post::all(); // Eloquent ORMを使用してすべての投稿を取得
        return view('posts.index', ['posts' => $posts]);
    }


    // /**
    //  * Show the form for creating a new resource.
    //  */
     public function create()
     {
         //
         return view('posts.create');
     }

    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
         //　データのバリデーション
        $request->validate([
             'title' => 'required|string|max:255', // タイトルは必須で文字列、最大255文字
             'body' => 'required|string', // 1MBまでの画像を許可
         ]);

        $post = new Post();
        $result = $post->createPost($request->all());

        // PostImageControllerを使用して画像を保存する
        if ($request->hasFile('images')) {
            $postImageController = new PostImageController();
            $postImageController->store($request, $result->id); // 作成した投稿のIDを渡す

        }

        return redirect()->route('posts.index');
    }


     /**
      * Display the specified resource.
      */
    public function show(Post $post)
     {
         return view('posts.show', ['post' => $post]);
     }

     public function edit(int $id)
     {
         $post = Post::findOrFail($id);
         return view('posts.edit', ['post' => $post]);
     }

     public function update(Request $request)
     {

         // バリデーション
         $request->validate([
             'id' => 'required|integer|exists:posts,id',
             'title' => 'required|string|max:255',
             'body' => 'required|string',
         ]);

         // データの更新
        $post = new Post();
        $result = $post->updatePost($request->all());

            // PostImageControllerを使用して画像を保存する
        if ($request->hasFile('images')) {
            $postImageController = new PostImageController();
            $postImageController->store($request, $result->id); // 作成した投稿のIDを渡す

        }

        return redirect()->route('posts.index');
     }

     public function destroy(int $id)
     {

        $post = new Post();
        $result = $post->deletePost($id);

        return redirect()->route('posts.index')->with('success', '投稿が削除されました。');
     }



    // // === 特定データの取得
    // public function getPostWithQueryBuilderByFilter()
    // {

    //     $post = new Post();
    //     $posts = $post->getPostWithQueryBuilderByFilter();
    //     //dd($posts);
    //     return $posts;
    // }
    // // カウント数
    // public function getCountPosts()
    // {
    //     $post = new Post();
    //     $count = $post->getCountPosts();
    //     return response()->json(['count' => $count], 200);
    // }

    // // データJOIN
    // public function getPostsAndUserWithQueryBuilder()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostsAndUserWithQueryBuilder();
    //     return $posts;
    // }

    // // サブクエリ
    // public function getPostsWithBuilderSubquery()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostsWithBuilderSubquery();
    //     return $posts;
    // }

    // // Eloquent ORMを使用してデータを取得
    // public function getPostWithEloquent()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostWithEloquent();

    //     // データ取得
    //     // Post::all();N+1

    //     foreach ($posts as $post) {
    //         $post;
    //     }

    //     return $posts;
    // }
    // // Eloquent ORMを使用してデータを取得(FIND)
    // public function getPostWithEloquentFind($id)
    // {

    //     $post = new Post();
    //     $posts = $post->getPostWithEloquentFind($id);
    //     return $posts;
    // }


    // public function getPostWithEloquentById($id)
    // {

    //     $post = new Post();
    //     $posts = $post->getPostWithEloquentById($id);
    //     return $posts;
    // }
    // // Eloquent ORMを使用してデータを追加
    // public function createPostWithEloquent(Request $request)
    // {
    //     $dummyData = (object)[
    //         'user_id' => 1,
    //         'title' => 'Eloquentで新しい投稿',
    //         'body' => 'Eloquentで新しい投稿の内容です。',
    //     ];
    //     //dd($dummyData);
    //     $post = new Post();
    //     $post->createPostWithEloquent($dummyData);
    //     return response()->json(['message' => '投稿が作成されました'], 201);
    // }



    // // Eloquent ORMを使用してデータを更新
    // public function updatePostWithEloquent()
    // {
    //     $dummyData = (object)[
    //         'id' => 23, // 更新する投稿のIDを指定
    //         'user_id' => 1,
    //         'title' => 'Eloquentで更新された投稿',
    //         'body' => 'Eloquentで更新された投稿の内容です。',
    //     ];
    //     //dd($dummyData);
    //     $post = new Post();
    //     $post->updatePostWithEloquent( $dummyData);
    //     return response()->json(['message' => '投稿が更新されました'], 200);
    // }

    // // Eloquent ORMを使用してデータを削除
    // public function deletePostWithEloquent($id)
    // {
    //     /*
    //     $dummyData = (object)[
    //         'id' => 23, // 削除する投稿のIDを指定
    //     ];
    //     */
    //     $post = new Post();
    //     $post->deletePostWithEloquent($id);
    //     return response()->json(['message' => '投稿が削除されました'], 200);
    // }

    // public function createPostWithNormalSql(Request $request)
    // {
    //     $dummyData = (object)[
    //         'user_id' => 1,
    //         'title' => '素のSQLで新しい投稿',
    //         'body' => '素のSQLで新しい投稿の内容です。',
    //     ];
    //     //dd($dummyData);
    //     $post = new Post();
    //     $post->createPostWithNormalSql($dummyData);
    //     return response()->json(['message' => '投稿が作成されました'], 201);
    // }

    // // データ取得
    // public function getPostWithQueryBuilder()
    // {
    //     $post = new Post();
    //     $posts = $post->GetPostWithQueryBuilder();
    //     return $posts;
    // }

    // // ゴミ箱データ取得
    // public function getPostWithEloquentOnlyTrashed()
    // {
    //     $post = new Post();
    //     $posts = $post->getPostWithEloquentOnlyTrashed();
    //     return $posts;
    // }


    // // データ追加
    // public function createPostWithQueryBuilder()
    // {
    //     $dummyData = (object)[
    //         'user_id' => 1,
    //         'title' =>'クエリービルダーで新しい投稿',
    //         'body' => 'クエリービルダーで新しい投稿の内容です。',
    //     ];
    //   $post = new Post();
    //   $post->createPostWithQueryBuilder($dummyData);
    // }

    // // データ更新
    // public function updatePostWithQueryBuilder()
    // {
    //     $dummyData = (object)[
    //         'id' => 11, // 更新する投稿のIDを指定
    //         'user_id' => 1,
    //         'title' => '更新された投稿ですBuilder',
    //         'body' => '更新された投稿の内容です。',
    //     ];
    //     //dd($dummyData);
    //     $post = new Post();
    //     $post->updatePostWithQueryBuilder($dummyData);
    //     return response()->json(['message' => '投稿が更新されました'], 200);
    // }

    // // データ削除
    // public function deletePostWithQueryBuilder()
    // {
    //     $dummyData = (object)[
    //         'id' => 11, // 更新する投稿のIDを指定
    //     ];
    //     $post = new Post();
    //     $post->deletePostWithQueryBuilder($dummyData);
    //     return response()->json(['message' => '投稿が削除されました'], 200);
    // }


    // // データ更新
    // public function updatePostWithNormalSql()
    // {
    //     $dummyData = (object)[
    //         'user_id' => 1,
    //         'title' => '更新された投稿',
    //         'body' => '更新された投稿の内容です。',
    //     ];
    //     //dd($dummyData);
    //     $post = new Post();
    //     $post->updatePostWithNormalSql($dummyData);
    //     return response()->json(['message' => '投稿が更新されました'], 200);
    // }

    // // データ削除
    // public function deletePostWithNormalSql()
    // {
    //     $dummyData = (object)[
    //         'id' => 16, // 更新する投稿のIDを指定
    //     ];


    //     $post = new Post();
    //     $post->deletePostWithNormalSql($dummyData);
    //     return response()->json(['message' => '投稿が削除されました'], 200);
    // }

    // // データ一括登録（トランザクションデータベース）
    // public function createBulkPostsWithTransaction()
    // {
    //     $dummyData = [
    //         (object)[
    //             'user_id' => 1,
    //             'title' => '1番目のトランザクションテスト投稿',
    //             'body' => '1番目のトランザクションテスト投稿の内容です。',
    //         ],
    //         (object)[
    //             'user_id' => 2, // ユーザーIDをnullにしてエラーを発生させる
    //             'title' => '2番目のトランザクションテスト投稿',
    //             'body' => '2番目のトランザクションテスト投稿の内容です。',
    //         ],
    //     ];

    //     $post = new Post();
    //     $post->createBulkPostWithNormalSql($dummyData);
    //     return response()->json(['message' => '複数の投稿が作成されました'], 201);
    // }



    //     // ビューにデータを渡す
    //     return view('posts.index', ['posts' => $posts]);
    //     //return route('posts.index_route');
    // }

    // public function indexRedirect()
    // {
    //     return redirect()->route('posts.index_route');
    // }

    // public function index2()
    // {
    //     // データを作成
    //     $posts = [
    //         (object)[
    //             'title' => '最初の投稿',
    //             'body' => 'これは最初の投稿の本文です。'],
    //         (object)[
    //             'title' => '2番目の投稿',
    //             'body' => 'これは2番目の投稿の本文です。'],
    //         (object)[
    //             'title' => '3番目の投稿',
    //             'body' => 'これは3番目の投稿の本文です。']
    //     ];

    //     // ビューにデータを渡す
    //     return view('posts.index2', ['posts' => $posts]);
    // }



    // // データ取得
    // public function indexNormalSql()
    // {
    //     $post = new Post();
    //     $posts = $post->GetPostWithNormalSql();
    //     return $posts;
    // }


    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //　データのバリデーション
    //     $request->validate([
    //         'image' => 'required|image|max:1024', // 1MBまでの画像を許可
    //         'caption' => 'nullable|string|max:255'
    //     ]);

    //     // 画像の保存
    //     $imagePath = $request->file('image')->store('public/images');

    //     // DBの保存
    //     Post::createPost($request->all());
    //     return response()->json(['message' => '画像が投稿されました'], 201);

    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Post $post)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Post $post)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Post $post)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Post $post)
    // {
    //     //
    // }
}
