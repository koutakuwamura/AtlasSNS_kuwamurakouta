@extends('layouts.logout')

@section('content')
  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => '/login']) !!}
  <div class="back">
    <p class="title">AtlasSNSへようこそ</p>

    {{ Form::label('e-mail', 'メールアドレス', ['class' => 'label']) }}
    {{ Form::text('mail', null, ['class' => 'input']) }}
    {{ Form::label('password', 'パスワード', ['class' => 'label']) }}
    {{ Form::password('password', ['class' => 'input']) }}

    {{ Form::submit('ログイン') }}

    <p class="a"><a href="/register">新規ユーザーの方はこちら</a></p>

    {!! Form::close() !!}
  </div>
@endsection
