@extends('layouts.login')

@section('content')
<div class="container">

    <form action="/search" method="post">
        @csrf
        <input type="text" name="keyword" class="form" placeholder="ユーザー名">
        <button type="submit"> <img src="images/search.png"></button>
    </form>

    @if (!empty($keyword))
        <p>検索ワード：{{$keyword}}</p>
    @endif

    @foreach ($users as $user)
        <div class="user-row">
            <td><img src="/storage/images/{{ $user->images }}"></td>
            <td>{{ $user->username }}</td>

            </tr>

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
        </div>
    @endforeach
</div>


@endsection
