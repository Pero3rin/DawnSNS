<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/script.js"></script>


</head>
<body>
    <header>
        <div class = "header_menu">
            <div class = "main_logo">
                <a href="/top">
                <img src="/storage/images/main_logo.png">
                </a>
            </div>

        <div id="menu-bar">
            <div id="toggle-button" class="rolling-button">
                V
            </div>
            <div>
                {{Auth::user()->username}}さん
                <img src="/storage/images/{{ Auth::user()->images }}"
                class="icon-img">
            </div>
        </div>
        <div class="nav-right">
            <nav>
                <ul>
                    <li><a href="/top">ホーム</a></li>
                    <li><a href="/profile">プロフィール編集</a></li>
                    <li><a href="/logout">ログアウト</a></li>
                </ul>
            </nav>
        </div>
        </div>
    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p>{{ $username }}さんの</p>
                <div>
                <p>フォロー数</p>
                <p>{{ $follow_count }}名</p>
                </div>
                <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                <div>
                <p>フォロワー数</p>
                <p>{{ $follower_count }}名</p>
                </div>
                <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="/search">ユーザー検索</a></p>

        </div>
    </div>
    <footer>
    </footer>

</body>
</html>
