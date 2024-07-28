<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added')->name('added');
Route::post('/added', 'Auth\RegisterController@added');

  Route::get('/logout', 'Auth\LoginController@logout');
  Route::post('/logout', 'Auth\LoginController@logout');


//ログイン中ページ　auth認証済
Route::group(['middleware' => ['auth']], function() {
Route::get('/top','PostsController@index')->name('top');
 Route::post('/top','PostsController@index');

 Route::get('/post','PostsController@create')->name('post.create');//表示
Route::post('/post','PostsController@store')->name('post.store');//投稿押した後
Route::get('/post/{id}/delete','PostsController@delete')->name('post.delete');//削除
 Route::get('/profile','UsersController@profile');//プロフィール

Route::get('/search','UsersController@search');//ユーザー検索

Route::get('/follow-list','FollowsController@followList');//ふぉろリスト

Route::get('/follower-list','FollowsController@followerList');//フォローワーページ
 });
