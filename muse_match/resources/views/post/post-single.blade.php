<!DOCTYPE html>
<html lang="ja">
<head>
    @include('components.head')
</head>
<body>
    @include('components.user-header')
    
    <div class="posts-area">
       <div class="post-item">
          <div class="post-user-id">
              <h2><a href="http://localhost:81/muse_match/public/user-page/{{$post->person_id}}">{{$post->person_name}}</a></h2>
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
   </div>
   
   <div class="message-create">
      <a href="http://localhost:81/muse_match/public/{{$post->person_id}}/post-single-{{$post->id}}/message">メッセージを送る</a>
   </div>

   <p class="messages-title">この募集文へのメッセージ</p>
    @isset($messages)
    <div class="messages-area">
        @foreach ($messages as $message)
            <div class="message-item">
                <div class="send-user">
                    <p>ID: {{$message->send_user_id}}</p>
                    <p>{{$message->send_user_name}}</p>
                </div>
                <div class="send-message">
                    <p>{{$message->message}}</p>
                    <p class="updated-at">{{$message->created_at}}</p>
                </div>
            </div>
        @endforeach
    </div>
    @endisset

    @include('components.user-footer')
</body>
</html>