
<header>
    <h1 class="header-logo">Muse Match</h1>
    @if ($url == 'http://localhost:81/muse_match/public/new' or $url == 'http://localhost:81/muse_match/public/login')
      <div class="container">
        <li class="user-hednav"><a href="{{$link}}">{{$text}}</a></li>
      </div>
    @else
      <div class="post-header-nav">
       <div class="container">
        <ul>
          @empty ($session)
             <li class="post-header-nav-item"><a href="http://localhost:81/muse_match/public/new">ユーザー登録</a></li>
             <li class="post-header-nav-item"><a href="http://localhost:81/muse_match/public/login">ログイン</a></li>
          @endempty
          @isset ($session)
             <li class="post-header-nav-item"><a href="http://localhost:81/muse_match/public/user-top">ユーザー情報</a></li>
             <li class="post-header-nav-item"><a href="http://localhost:81/muse_match/public/update">ユーザー情報編集</a></li>
             <li class="post-header-nav-item"><a href="http://localhost:81/muse_match/public/pr-update">プロフィール入力</a></li>
             <li class="post-header-nav-item"><a href="http://localhost:81/muse_match/public/post-new">募集分投稿</a></li>
          @endisset
             <li class="post-header-nav-item"><a href="http://localhost:81/muse_match/public/posts">全投稿一覧</a></li>
        </ul>
       </div>
      </div>
    @endif
</header>