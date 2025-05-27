<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Follow;
use Auth;

class PostsController extends Controller
{
    /**
     * 投稿一覧ページの表示
     */
    public function index()
    {
        // ログインユーザーのID取得
        $userId = Auth::id();

        // フォローしているユーザーのID一覧を取得
        $followedUserIds = Follow::where('following_id', $userId)->pluck('followed_id')->toArray();

        // 自分のIDも追加
        $followedUserIds[] = $userId;

        // フォローしているユーザー + 自分 の投稿を取得
        $posts = Post::with('user')
            ->whereIn('user_id', $followedUserIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * 新規投稿ページの表示（※現時点では未使用かも）
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * 新規投稿を保存する処理
     */
    public function store(Request $request)
    {
        // フォームから送られてきた投稿内容を取得
        $post = $request->input('newPost');

        // 現在ログイン中のユーザーIDを取得
        $user_id = Auth::id();

        // 新しい投稿を作成（DBに保存）
        Post::create([
            'user_id' => $user_id,
            'post' => $post,
        ]);

        // 元のページにリダイレクト（投稿完了後）
        return back();
    }

    /**
     * 投稿の削除処理
     */
    public function delete($id)
    {
        // 指定されたIDの投稿を削除
        Post::where('id', $id)->delete();

        // 削除後に元のページに戻る
        return back();
    }
}
