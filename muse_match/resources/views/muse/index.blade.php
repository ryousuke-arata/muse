<!DOCTYPE html>
<html lang="ja">
<head>
    @include('components.head')
</head>
<body>
    <header>
        @include('components.user-header')
        @php
          $keys = array_keys($fav_counts);
          $key = max($keys);
          $count = 0;
        @endphp
    </header>
    
    <div class="posts-area">
    @foreach ($posts as $post)
     @while ($count <= $key)
      <a href="http://localhost:81/muse_match/public/post-single-{{$post->id}}">
        <div class="post-item">
            <div class="post-user-id">
                <h2>{{$post->person_name}}</h2>
            </div>
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
        </div>
      </a>
      @php
          $count++
      @endphp
     @endwhile
    @endforeach
    </div>

    @include('components.user-footer')
</body>
</html>