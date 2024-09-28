@extends('layouts.login')

@section('content')

    <div class="container">
        <h2 class='page-header'></h2>
       {!! Form::open(['url' => '/profile']) !!}
       {{Form::token()}}

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

        <tr>
          <p><img src="images/{{ Auth::user()->images }}"></p>
        <label for="name">ユーザー名</label>
        <input type="text" class="form-control" name="upusername" value="{{ Auth::user()->username }}">
          <br>
          <label for="name">メールアドレス</label>
        <input type="text" class="form-control" name="upmail" value="{{ Auth::user()->mail }}">

           <br>
           <label for="password">パスワード：</label>
    <input type="password" id="password" name="uppassword" value="" required >
    <!-- required 必須項目に使う-->
           <br>
          <label for="password">パスワード：</label>
    <input type="password" id="password" name="uppassword" value="" required >

           <br>
          <label for="name">自己紹介</label>
        <input type="text" class="form-control" name="upbio" value="{{ Auth::user()->bio }}">
           <br>
          <div class="form-group row">
                <label for="name">アイコン画像</label>
                <div class="col-sm-8" >
                     <input type="file" name="images">


                </div>
            </div>

       </tr>

        </div>
        <button type="submit" class="btn btn-primary pull-right" >更新</button>
        {{ Form::close() }}
    </div>


@endsection
