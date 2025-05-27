@extends('layouts.login')

@section('content')

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
        <img src="/storage/images/{{ Auth::user()->images }}">
        @csrf

        {{ Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) }}

    </div>
    <button type="submit">
        <img src="/images/post.png">
    </button>

    <table class="table table-hover">

        @foreach ($posts as $post)

            <img src="/storage/images/{{ $post->user->images }}">
            <p>{{ $post->user->username }}</p>
            <p>{{ $post->post }}</p>
            <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>
            <a href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの本を削除してもよろしいでしょうか？')">
                <!-- <img src="/images/trash-h.png"> -->
            </a>

        @endforeach

    </table>


    {!! Form::close() !!}







@endsection
