@extends('layouts.login')


@section('content')
<p>フォロワーリスト</p>


<div class="container">
    @foreach ($followers as $follower)
        <div class="follower-user">
            <a href="/profiles/{{ $follower->id }}" method="post">
                <td><img src="/storage/images/{{ $follower->images }}"></td>
            </a>
        </div>
    @endforeach
    @foreach ($posts as $post)
        <div class="follower-posts">
            <div class="follower-post">
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
