<!DOCTYPE html>
<html lang="ja">
<head>
    @include('components.head')
</head>
<body>
    <header>
        @include('components.user-header')
    </header>
    
    <div class="posts-area">
    @foreach ($posts as $post)
      <a href="http://localhost:81/muse_match/public/post-single-{{$post->id}}">
        <div class="post-item">
            <div class="post-user-id">
                <h2>{{$post->person_name}}</h2>
            </div>
            <div class="post-title">
                <h3><span>タイトル： </span>{{$post->title}}</h3>
            </div>
            <div class="post-parts">
                <p class="parts-title">・募集楽器</p>
                <p>{{$post->parts}}</p>
            </div>
            <div class="post-content">
                <p>{{$post->content}}</p>
                <p class="updated-at">{{$post->updated_at}}</p>
            </div>
        </div>
      </a>
    @endforeach
    </div>

    @include('components.user-footer')
</body>
</html>