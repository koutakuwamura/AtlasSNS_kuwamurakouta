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

          <table class="table table-hover">
       <tr>
          <th>ID</th>
          <th>ユーザー</th>
          <th>投稿</th>
          <th>登録日時</th>
          <th>更新日時</th>
          <th></th>
          <th></th>
       </tr>
       @foreach ($posts as $post)
       <tr>
          <td>{{ $post->id }}</td>
          <td>{{ $post->user_id }}</td>
          <td>{{ $post->post }}</td>
          <td>{{ $post->created_at }}</td>
          <td>{{ $post->updated_at }}</td>
           <td><a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの本を削除してもよろしいでしょうか？')">削除</a></td>
       </tr>
    @endforeach

</table>


 {!! Form::close() !!}







@endsection
