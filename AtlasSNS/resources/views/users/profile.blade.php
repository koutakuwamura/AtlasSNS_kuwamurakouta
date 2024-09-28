@extends('layouts.login')

@section('content')

<div class="container">
    <h2 class='page-header'></h2>
    {!! Form::open(['url' => '/profile', 'method' => 'post', 'files' => true]) !!}
    {{ Form::token() }}

    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <p><img src="images/{{ Auth::user()->images }}"></p>

        <label for="name">ユーザー名</label>
        <input type="text" class="form-control" name="upusername" value="{{ Auth::user()->username }}">
        <br>

        <label for="email">メールアドレス</label>
        <input type="text" class="form-control" name="upmail" value="{{ Auth::user()->mail }}">
        <br>

        <label for="password">パスワード</label>
        <input type="password" id="password" class="form-control" name="uppassword" required>
        <br>

        <label for="password_confirmation">パスワード確認</label>
        <input type="password" id="password_confirmation" class="form-control" name="uppassword_confirmation" required>
        <br>

        <label for="bio">自己紹介</label>
        <input type="text" class="form-control" name="upbio" value="{{ Auth::user()->bio }}">
        <br>

        <div class="form-group row">
            <label for="images">アイコン画像</label>
            <div class="col-sm-8">
                <input type="file" name="images">
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary pull-right">更新</button>
    {!! Form::close() !!}
</div>

@endsection
