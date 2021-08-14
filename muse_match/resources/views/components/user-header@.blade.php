<header>
    <h1 class="header-logo">Muse Match</h1>
    @if (isset($_POST['add']) or $url == 'http://localhost:81/muse_match/public/update' or $url == 'http://localhost:81/muse_match/public/pr-update' or $url == 'http://localhost:81/muse_match/public/post-new' or $url == 'http://localhost:81/muse_match/public/user-top')
        <ul>
            <li class="post-header-nav"><a href="http://localhost:81/muse_match/public/update">ユーザー情報編集</a></li>
           <li class="post-header-nav"><a href="http://localhost:81/muse_match/public/pr-update">プロフィール入力</a></li>
           <li class="post-header-nav"><a href="http://localhost:81/muse_match/public/post-new">募集分投稿</a></li>
           <li><a href="http://localhost:81/muse_match/public/test">セッション確認</a></li>
        </ul>
    @else
        <li class="user-hednav"><a href="{{$link}}">{{$text}}</a></li>
    @endif
</header>