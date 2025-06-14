<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/top-header.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div class="head">
            <a href="/top"><img src="/storage/images/atlas.png"></a>
        </div>

        <div class="right">
            <p class="h-username">{{ Auth::user()->username }}
                さん


            <div class="include-accordion">
                <li>
                    <button class="accordionBtn" type="button" id="accordion"></button>
                    <ul>
                        <li><a href="/top">ホーム</a></li>
                        <li><a href="/profile">プロフィール</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                </li>

        </div>
        <div class="h-images"><img src="/storage/images/{{ Auth::user()->images }}"></p>
        </div>

        </div>
        </div>
        </div>

    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p class="s-username">{{ Auth::user()->username }}さんの</p>
                <div class="following">
                    <p>フォロー数</p>
                    <p>{{ Auth::user()->following->count() }}人</p>
                </div>
                <button class="btn-follow" onclick="location.href='/follow-list'">
                    <p>フォローリスト</p>
                </button>
                <div class="follower">
                    <p>フォロワー数</p>
                    <p>{{ Auth::user()->followers->count() }}人</p>
                </div>
                <button class="btn-follow" onclick="location.href='/follower-list'">フォロワーリスト</button>
            </div>
            <hr style="border: none; border-top: 1px solid #ccc; ">
            <form action="/search" method="GET">
                <button class="btn-search" type="submit">ユーザー検索</button>
            </form>
        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('js/accordion.js') }}"></script>
    <script src="JavaScriptファイルのURL"></script>
</body>
</html>
