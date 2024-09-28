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
   <tr>
    <td><img src="images/{{ $user->images }}" ></td>
    <td>{{ $user->username }}</td>

       </tr>
       @endforeach
</div>


@endsection
