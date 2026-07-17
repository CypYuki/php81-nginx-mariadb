<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // IDでユーザーをデータベースから取得
    public function getUserById($id)
    {
        $user = User::find($id);
        dd($user->posts); // ユーザに紐づく投稿を取得
        return $user;
    }

    /**
     * 一括割り当て可能な属性。
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * シリアライズ時に隠す属性。
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        // 1つのユーザは複数の投稿を持つことができる
        return $this->hasMany(Post::class);
    }

    /**
     * キャストすべき属性。
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // データベースからすべてのユーザーを取得
    public function getAllUsers()
    {
        $user = User::all();
        return $user;
    }



    // IDでユーザーをデータベースで更新
    public function updateUserById($id, $data)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    // ユーザーを削除
    public function deleteUserById($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }



}
