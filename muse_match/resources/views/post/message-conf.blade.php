<!DOCTYPE html>
<html lang="ja">
<head>
    @include('components.head')
</head>
<body>
    <header>
        @include('components.user-header')
    </header>

    <div class="messages">
        <div class="message-conf">
            <p>{{$message->message}}</p>
            <p></p>
            <p>メッセージを送信しました</p>
        </div>
    </div>
</body>
</html>