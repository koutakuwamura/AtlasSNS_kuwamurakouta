<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Follow;
use Auth;

class FollowsController extends Controller
{
    /**
     * フォロワー一覧ページの表示
     * 自分をフォローしているユーザーの投稿・情報を取得
     */
    public function followerList()
    {
        // 全ユーザーを取得（表示用などに使う）
        $users = User::get();

        // 現在ログインしているユーザーのIDを取得
        $id = Auth::id();

        // 自分をフォローしているユーザーのID一覧を取得
        $followerIds = Follow::where('followed_id', $id)->pluck('following_id');

        // フォロワーのユーザー情報を取得
        $followers = User::whereIn('id', $followerIds)->get();

        // フォロワーたちの投稿を取得（新しい順に並べる）
        $posts = Post::with('user')
            ->whereIn('user_id', $followerIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // フォロー数（自分がフォローしている人数）
        $followingsCount = Follow::where('following_id', $id)->count();

        // フォロワー数（自分をフォローしている人数）
        $followersCount = $followerIds->count();

        // ビューに必要なデータを渡して表示
        return view('follows.followerList', [
            'users' => $users,
            'followers' => $followers,
            'posts' => $posts,
            'followersCount' => $followersCount,
            'followingsCount' => $followingsCount
        ]);
    }
    /**
     * フォロー一覧ページの表示
     * 自分がフォローしているユーザーの投稿・情報を取得
     */
    public function followList()
    {
        $users = User::get();
        $id = Auth::id();

        // 自分がフォローしているユーザーのIDを取得（修正済み）
        $followingIds = Follow::where('following_id', $id)->pluck('followed_id');

        // フォローしているユーザーの情報を取得
        $followings = User::whereIn('id', $followingIds)->get();

        // フォローしているユーザーの投稿を取得
        $posts = Post::with('user')
            ->whereIn('user_id', $followingIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // 自分のフォロー数
        $followingsCount = $followingIds->count();

        // 自分のフォロワー数
        $followersCount = Follow::where('followed_id', $id)->count();

        return view('follows.followList', [
            'users' => $users,
            'followings' => $followings, // ← ここも修正
            'posts' => $posts,
            'followersCount' => $followersCount,
            'followingsCount' => $followingsCount
        ]);
    }

    /**
     * 指定ユーザーをフォローする処理
     * すでにフォローしていなければ、新しいFollowレコードを作成
     */
    public function follow($id)
    {
        // 指定ユーザーをフォローしているか確認（UserモデルにisFollowingメソッドが必要）
        $follow = Auth::user()->isFollowing($id);

        if (!$follow) {
            // フォローしていない場合は、新規作成
            Follow::create([
                'following_id' => Auth::id(),
                'followed_id' => $id,
            ]);
        }

        // 検索ページにリダイレクト
        return redirect('/search');
    }

    /**
     * 指定ユーザーのフォローを解除する処理
     */
    public function unfollow($id)
    {
        // フォローしている関係を1件取得
        $unfollow = Follow::where('following_id', Auth::id())
            ->where('followed_id', $id)
            ->first();

        // 存在する場合は削除
        if ($unfollow) {
            $unfollow->delete();
        }

        // 検索ページにリダイレクト
        return redirect('/search');
    }

    /**
     * フォローしている相手のプロフィールを表示
     */
    public function followprofile($id)
    {
        // 指定IDのユーザーを取得（存在しない場合は404）
        $user = User::findOrFail($id);

        // 指定ユーザーの投稿一覧を取得（新しい順）
        $posts = Post::with('user')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // ビューにデータを渡して表示
        return view('users.profiles', [
            'user' => $user,
            'id' => $id,
            'posts' => $posts
        ]);
    }
}
