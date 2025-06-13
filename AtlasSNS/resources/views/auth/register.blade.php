@extends('layouts.logout')

@section('content')
  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => '/register']) !!}
  <div class="back">
    <p class="title">新規ユーザー登録</p>

    {{ Form::label('username', 'ユーザー名', ['class' => 'label'])}}
    {{ Form::text('username', null, ['class' => 'input']) }}


    {{ Form::label('e-mail', 'メールアドレス', ['class' => 'label']) }}
    {{ Form::text('mail', null, ['class' => 'input']) }}

    {{ Form::label('password', 'パスワード', ['class' => 'label']) }}
    {{ Form::password('password', ['class' => 'input']) }}

    {{ Form::label('password_confirmation', 'パスワード確認確認', ['class' => 'label']) }}
    {{ Form::password('password_confirmation', ['class' => 'input']) }}


    {{ Form::submit('新規登録') }}

    <p class="a"><a href="/login">ログイン画面へ戻る</a></p>

    {!! Form::close() !!}
  </div>

@endsection
