@extends('layouts.logout')

@section('content')
  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => '/register']) !!}
  <div class="back">
    <p class="title">新規ユーザー登録</p>

    {{ Form::label('username', 'ユーザー名', ['class' => 'label'])}}
    {{ Form::text('username', null, ['class' => 'input']) }}
    @if ($errors->has('username'))
    <p class="error">{{ $errors->first('username') }}</p>
    @endif


    {{ Form::label('e-mail', 'メールアドレス', ['class' => 'label']) }}
    {{ Form::text('mail', null, ['class' => 'input']) }}
    @if ($errors->has('mail'))
    <p class="error">{{ $errors->first('mail') }}</p>
    @endif

    {{ Form::label('password', 'パスワード', ['class' => 'label']) }}
    {{ Form::password('password', ['class' => 'input']) }}
    @if ($errors->has('password'))
    <p class="error">{{ $errors->first('password') }}</p>
    @endif

    {{ Form::label('password_confirmation', 'パスワード確認確認', ['class' => 'label']) }}
    {{ Form::password('password_confirmation', ['class' => 'input']) }}
    @if ($errors->has('password_confirmation'))
    <p class="error">{{ $errors->first('password_confirmation') }}</p>
    @endif


    {{ Form::submit('新規登録') }}

    <p class="a"><a href="/login">ログイン画面へ戻る</a></p>

    {!! Form::close() !!}
  </div>

@endsection
