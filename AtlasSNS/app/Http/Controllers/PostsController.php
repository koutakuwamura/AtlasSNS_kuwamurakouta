<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Follow;
use Auth;

class PostsController extends Controller
{
    //


    public function index()
    {
        $posts = Post::get(); //Postモデル（postsテーブル）からレコード情報を取得
        $follows = Follow::get();
        return view('posts.index', ['posts' => $posts, 'follows' => $follows]);

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        $post = $request->input('newPost');
        $user_id = Auth::id();

        Post::create([

            'user_id' => $user_id,

            'post' => $post,

        ]);
        return back();


    }

    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return back();

    }


}
