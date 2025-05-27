<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Follow;
use Auth;
class FollowsController extends Controller
{


    public function followList()
    {

        $users = User::get(); //Userモデル（usersテーブル）からレコード情報を取得
        $id = Auth::id();

        $followingIds = Follow::where('following_id', $id)->pluck('followed_id');
        $followings = User::whereIn('id', $followingIds)->get(); // フォローしているユーザーを取得
        $posts = Post::with('user')->whereIn('user_id', $followingIds)->orderBy('created_at', 'desc')->get();

        // フォロー数とフォロワー数を取得
        $followingsCount = $followingIds->count();
        $followersCount = Follow::where('followed_id', $id)->count();

        return view('follows.followList', ['users' => $users, 'followings' => $followings, 'posts' => $posts, 'followersCount' => $followersCount, 'followingsCount' => $followingsCount]);
    }


    public function followerList()
    {

        $users = User::get(); //Userモデル（usersテーブル）からレコード情報を取得
        $id = Auth::id();

        $followerIds = Follow::where('followed_id', $id)->pluck('following_id');
        $followers = User::whereIn('id', $followerIds)->get(); // フォローしているユーザーを取得

        $posts = Post::with('user')->whereIn('user_id', $followerIds)->orderBy('created_at', 'desc')->get();

        // フォロー数とフォロワー数を取得
        $followingsCount = Follow::where('following_id', $id)->count();
        $followersCount = $followerIds->count();

        return view('follows.followerList', ['users' => $users, 'followers' => $followers, 'posts' => $posts, 'followersCount' => $followersCount, 'followingsCount' => $followingsCount]);

    }

    public function follow($id)
    {
        $follow = Auth::user()->isFollowing($id);

        if (!$follow) {
            Follow::create([

                'following_id' => \Auth::user()->id,

                'followed_id' => $id,
            ]);
        }



        return redirect('/search');
    }




    public function unfollow($id)
    {
        $unfollow = Follow::where('following_id', \Auth::user()->id)->where('followed_id', $id)->first();
        //->first();1つだけ取得する　
        $unfollow->delete();


        return redirect('/search');
    }

    public function followprofile($id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        $posts = Post::with('user')->where('user_id', $id)->orderBy('created_at', 'desc')->get();


        return view('users.profiles', ['user' => $user, 'id' => $id, 'posts' => $posts]);
    }

}
