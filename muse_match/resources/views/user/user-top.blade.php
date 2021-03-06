<!DOCTYPE html>
<html lang="ja">
<head>
    @include('components.head')
    @php
        $keys = array_keys($fav_counts);
        $key = max($keys);
        $count = 0;
    @endphp
</head>
<body>
    <header>
        @include('components.user-header')
    </header>

    <table class="profile-table">
        <tr>
            <th>ユーザーID</th>
            <th>ユーザー名</th>
        </tr>
        <tr>
            <td class="profile-td">{{$session->id}}</td>
            <td class="profile-td">{{$session->name}}</td>
        </tr>
    </table>
    <table class="profile-table">
        <tr>
            <th>自己PR</th>
            <td class="profile-ta">{{$session->pr}}</td>
        </tr>
    </table>
    
    @if ($posts != '')
    <div class="posts-area">
        @foreach ($posts as $post)
           @while ($count <= $key)
            @if ($url != "http://localhost:81/muse_match/public/user-top")
              <a href="http://localhost:81/muse_match/public/messages/{{$post->id}}">
            @endif
                <div class="post-item">
                  <div class="post-title">
                     <h3><span>タイトル： </span>{{$post->title}}</h3>
                  </div>
                  <div class="post-parts">
                      <p class="parts-title">・開催場所</p>
                      <p>{{$post->venue}}</p>
                  </div>
                  <div class="post-parts">
                      <p class="parts-title">・開催日時</p>
                     <p>{{$post->start_date}}{{$post->start_time}}</p>
                  </div>
                  <div class="post-content">
                      <p>{{$post->content}}</p>
                      <p class="updated-at">{{$post->updated_at}}</p>
                  </div>
                  <div class="fav-area">
                      <img src="../public/storage/ハートのマーク.png" alt="いいねの数">
                      <p>{{$fav_counts[$count]}}</p>
                  </div>
                  @php
                     $count++;   
                  @endphp
                </div>
             @if ($url != "http://localhost:81/muse_match/public/user-top")
              </a>
             @endif
            @endwhile
        @endforeach
    </div>
    @endif
    <div class="follow-btn">
        <form action='http://localhost:81/muse_match/public/user-page/{{$session->id}}' method="post">
            @csrf
            <input type="submit" name="follow" hidden="{{$session->id}}" value="フォロー">
        </form>
    </div>

    @include('components.user-footer')
</body>
</html>