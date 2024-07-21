@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
 <!-- <from action="{{ url('/post')}}" method="POST">
  @csrf

  <input type="hidden" name="_token" value="{{ csrf_token()}}">
  <div>
    <input type="text" name="post" value="" class="form-control" placeholder="内容の入力" required> </div>
<button type="submit" class="btn btn-success pull-right">送信</button>
</from>
-->
{!! Form::open(['url' => '/post']) !!}
{{Form::token()}}
     <div class="form-group">
         {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) }}
     </div>
     <button type="submit" class="btn btn-success pull-right">追加</button>
 {!! Form::close() !!}







@endsection
