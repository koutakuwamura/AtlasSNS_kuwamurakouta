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

$up_username = $request->input('upusername');
$up_mail = $request->input('upmail');
$up_password = $request->input('uppassword');
$up_bio = $request->input('upbio');
$up_image = $request->file('images');
dd($up_image);
if ($request->hasFile('upimage')) {

      $path = Storage::disk('public')->putFile('upimage', $up_image);
    dd($id,$up_username,$up_mail,$up_password,$up_bio,$up_image);}


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
//  $request->validate([
//           'username'  => 'required|min:2|max:12',
//           'mailadress' => 'required|email|unique:users,mail|min:5|max:40',
//           'newpassword' => 'required|string|alpha_num|min:8|max:20|confirmed',
//           'newPasswordConfirmation' => 'required|string|alpha_num|min:8|max:20|same:password',
//           'bio' => 'required|string|max:150',
//                'iconimage' => 'required|image',]);
