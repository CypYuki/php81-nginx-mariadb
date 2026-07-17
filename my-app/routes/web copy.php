<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\User;
use App\Http\Controllers\PostImageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create_route');

Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts/show/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/posts/{post}', [PostController::class, 'edit'])->name('posts.edit');

Route::put('/posts/update', [PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/delete/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::put('/posts/images/{post}', [PostImageController::class, 'store'])->name('posts.images.store');

// Route::prefix('posts')->group(function () {
//     // ここで共通の処理を実行することができます(postsを省略して、グループ化)
//     Route::get('/create', [PostController::class, 'create']);
//     Route::get('/edit', [PostController::class, 'edit']);
//     Route::get('/show', [PostController::class, 'show']);
//     Route::get('/delete', [PostController::class, 'delete']);

// });

// //　無名関数を使用したルート定義
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/hello', function () {
//     return 'Hello, World!';
// });

// Route::get('/user/{id}', [PostController::class, 'getUserById']);

// Route::get('/posts2', [PostController::class, 'index2']);

// Route::get('/posts3', [PostController::class, 'indexNormalSql']);

// // 認証(auth)ミドルウェアを使用して、認証が必要なルートをグループ化
// Route::middleware('auth')->group(function () {
//     Route::post('/posts', [PostController::class, 'store']);
// });

// // リダイレクト
// Route::get('/posts/redirect', [PostController::class, 'indexRedirect']);



// Route::post('/posts', [PostController::class, 'store']);

// Route::post('/posts/create/normalsql', [PostController::class, 'createPostWithNormalSql']);

// Route::put('/posts/update/normalsql', [PostController::class, 'updatePostWithNormalSql']);

// Route::delete('/posts/delete/normalsql', [PostController::class, 'deletePostWithNormalSql']);

// Route::post('/posts/bulkcreate/transaction', [PostController::class, 'createBulkPostsWithTransaction']);

// Route::post('/posts/create/querybuilder', [PostController::class, 'createPostWithQueryBuilder']);

// Route::get('/posts/show/querybuilder', [PostController::class, 'getPostWithQueryBuilder']);

// Route::post('/posts/update/querybuilder', [PostController::class, 'updatePostWithQueryBuilder']);

// Route::delete('/posts/delete/querybuilder', [PostController::class, 'deletePostWithQueryBuilder']);

// Route::get('/posts/filter/querybuilder', [PostController::class, 'getPostWithQueryBuilderByFilter']);

// Route::get('/posts/count/querybuilder', [PostController::class, 'getCountPosts']);

// Route::get('/posts/join/querybuilder', [PostController::class, 'getPostsAndUserWithQueryBuilder'] );

// Route::get('/posts/subquery/querybuilder', [PostController::class, 'getPostsWithBuilderSubquery']   );

// Route::get('/posts/eloquent', [PostController::class, 'getPostWithEloquent']);

// Route::get('/posts/eloquent/find/{id}', [PostController::class, 'getPostWithEloquentFind']);

// Route::post('/posts/eloquent/create', [PostController::class, 'createPostWithEloquent']);

// Route::put('/posts/eloquent/update', [PostController::class, 'updatePostWithEloquent']);

// Route::get('/posts/show/eloquent/{id}', [PostController::class, 'getPostWithEloquentById']);


// Route::delete('/posts/eloquent/delete/{id}', [PostController::class, 'deletePostWithEloquent']);

// Route::get('/posts/eloquent/onlytrashed', [PostController::class, 'getPostWithEloquentOnlyTrashed']);

