@extends('layouts.login')

@section('content')


<div class="container">
  <h2 class='page-header'></h2>

  <div class="form-group">
    <p><img src="/storage/images/{{$user->images }}"></p>
    <th>ユーザー名</th>
    <td>{{ $user->username }}</td>
    <br>

    <th>自己紹介</th>
    <td>{{ $user->bio }}</td>
    <br>

    <div class="follow-button">
      @if (auth()->check() && optional(auth()->user()->following)->contains($user->id))
      <form action="/unfollow/{{ $user->id }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger">フォロー解除</button>
      </form>
    @else
      <form action="/follow/{{ $user->id }}" method="POST">

      @csrf
      <button type="submit" class="btn btn-primary">フォローする</button>
      </form>
    @endif
    </div>

    @foreach ($posts as $post)
    <div class="following-posts">
      <div class="following-post">
      <img src="/storage/images/{{ $post->user->images }}">
      <p>{{ $post->user->username }}</p>
      <p>投稿した内容を表示します。</p>
      <p>{{ $post->post }}</p>
      <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
      </div>
    </div>
  @endforeach
  </div>


</div>

@endsection
