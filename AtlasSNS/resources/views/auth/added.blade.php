@extends('layouts.logout')

@section('content')

  <div class="back">
    <p class="added">{{ Session::get('username') }}さん</p>
    <p class="added-text">ようこそ！AtlasSNSへ！</p>
    <p class="added">ユーザー登録が完了しました。</p>
    <p class="added-text">早速ログインをしてみましょう。</p>

    <a href="{{ url('/login') }}" class="btn">ログイン画面へ</a>

  </div>

@endsection
