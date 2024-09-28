<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
class UsersController extends Controller
{
public function profile(Request $request){
   $users = User::get();
   $id = Auth::id();

   if($request->isMethod('post')){
      //  $request->validate([
      //     'upusername'  => 'required|min:2|max:12',
      //     'upmail' => 'required|email|unique:users,mail|min:5|max:40,' . $id,
      //     'uppassword' => 'required|string|alpha_num|min:8|max:20|confirmed',
      //     'uppassword_confirmation' => 'required|string|alpha_num|min:8|max:20|same:password',
      //     'upbio' => 'required|string|max:150',
      //          'images' => 'required|image',]);

$up_username = $request->input('upusername');
$up_mail = $request->input('upmail');
$up_password = $request->input('uppassword');
$up_bio = $request->input('upbio');
$up_image = $request->file('images');
// dd($id,$up_username,$up_mail,$up_password,$up_bio,$up_image);

if ($request->hasFile('images')) {

     $path = $request->file('images')->store('images', 'public');
     $up_image->images = $path;
   }
else{
   //元画像入れる{{ Auth::user()->images }}
}

     User::where('id', $id)->update([
            'username' => $up_username,
            'mail' => $up_mail,
            'password' =>bcrypt($up_password),
            'bio' => $up_bio,
           'images' => $up_image,
        ]);
        return redirect('/top');
     }

     return view('users.profile');


    }
     public function search(Request $request){

        $users = User::get(); //Userモデル（usersテーブル）からレコード情報を取得
        $keyword = $request->input('keyword');
        $user_id= Auth::id();//Laravel 認証済みユーザーの取得方法

        if(!empty($keyword)){
             $users = User::where('username','like', '%'.$keyword.'%')->where('id','!=', $user_id)->get();
        }//'%'はあいまい検索の頭尻文字、whereの絞り込みは続けてっくことが可能

        else{
             $users = User::where('id','!=', $user_id)->get();
        }//比較演算子　https://qiita.com/ymym4432/items/4b828ddca520f9b266e2
        return view('users.search',['users'=>$users],['keyword'=>$keyword]);
}

}
