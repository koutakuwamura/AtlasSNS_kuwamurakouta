<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostsController extends Controller
{
    //


     public function index()
    {
        $posts = Post::get(); //Postモデル（postsテーブル）からレコード情報を取得
        return view('posts.index',['posts'=>$posts]);

    }

    public function create()
    {
      return view('posts.create');
    }

    public function store(Request $request)
    {
      // $post = new Post;

      // $post->id =$request->session()->get('id');
      // $post->user_id = $request->user_id;
      //  $post = $request->input('post');
      //   Posts::create(['post' => $post]);

      // $post->save();
       $post = $request->input('newPost');
       $user_id= Auth::id();
      //  dd($user_id);
        // Post::create([
        //   'user_id' => $user_id,
        //   'post' => $post,
        // ]);
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
