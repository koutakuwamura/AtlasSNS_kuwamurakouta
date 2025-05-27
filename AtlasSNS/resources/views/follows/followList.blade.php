@extends('layouts.login')
@section('content')
<p>フォローリスト</p>
<div class="container">
    @foreach ($followings as $following)
        <div class="following-user">
            <a href="/profiles/{{ $following->id }}" method="post">
                <td><img src="/storage/images/{{ $following->images }}"></td>
            </a>
        </div>
    @endforeach
    @foreach ($posts as $post)
        <div class="following-posts">
            <div class="following-post">
                <a href="/profiles/{{ $post->user_id }}" method="post">
                    <img src="/storage/images/{{ $post->user->images }}">
                </a>
                <p>{{ $post->user->username }}</p>
                <p>{{ $post->post }}</p>
                <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection
<!-- <td><a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの本を削除してもよろしいでしょうか？')">削除</a></td> -->
<!-- 投稿の写真からユーザー一覧に行けるようにする。$postと$followingで$idが変わってしまう -->
