<!DOCTYPE html>
<html lang="ja">
<head>
   @include('components.head')
</head>
<body>
    @include('components.user-header')
@php
    var_dump($messages);
@endphp
    <p class="message-title">・メッセージ一覧</p>
  @if(empty($messages[0]->id))
    <div class="no-messages">
        <p>この投稿宛のメッセージはありません</p>
    </div>
  @else
    <div class="messages-area">
       <div class="receive-messages-area">
           @foreach ($messages as $message)
               <div class="message-item">
                   <div class="recieve-post-title">
                       <p>投稿タイトル： {{$message->source_title}}</p>
                   </div>
                   <div class="send-user">
                       <p>送信してきたユーザーID: {{$message->send_user_id}}</p>
                       <p>送信者名{{$message->send_user_name}}</p>
                   </div>
                   <div class="send-message">
                       <p>{{$message->message}}</p>
                       <p class="updated-at">{{$message->created_at}}</p>
                   </div>
               </div>
               <div class="reply-message-btn">
                   <a href="http://localhost:81/muse_match/public/post-{{$message->source_post_id}}/message-{{$message->id}}/reply">返信する</a>
               </div>
               @isset($reply_message)
                <div class="message-item">
                    <div class="recieve-post-title">
                       <p>投稿タイトル： {{$reply_message->source_title}}</p>
                    </div>
                    <div class="send-user">
                       <p>送信してきたユーザーID: {{$replay_message->send_user_id}}</p>
                       <p>送信者名{{$reply_message->send_user_name}}</p>
                    </div>
                    <div class="send-message">
                       <p>{{$reply_message->message}}</p>
                       <p class="updated-at">{{$reply_message->created_at}}</p>
                    </div>
                </div>
                <div class="reply-message-btn">
                   <a href="http://localhost:81/muse_match/public/post-{{$message->source_post_id}}/reply_message-{{$reply_message->id}}/reply">返信する</a>
                </div>
               @endisset
           @endforeach
       </div>
    </div>
  @endif

    @include('components.user-footer')
</body>
</html>