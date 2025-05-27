<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
    //クラス無しの表記出たらclassチェック
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'images',
        'mail',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    // ユーザーがフォローしている他のユーザー（多対多のリレーション）
    public function following()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }

    // ユーザーをフォローしているユーザー（多対多のリレーション）
    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }
    // フォローしているか確認するメソッド
    public function isFollowing($id)
    {
        return $this->following()->where('followed_id', $id)->exists();
    }

    // フォローされているか確認するメソッド
    public function isFollowedBy($user)
    {
        return $this->followers()->where('following_id', $user)->exists();
    }


    public function posts()
    {
        return $this->hasMany('App\Post');

    }
}
