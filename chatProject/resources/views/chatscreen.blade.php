<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body class="chatscreen-body">
    <div class="chat-con">
        <div class="reciverName-con">
           @if($toUser)
           <span class="reciverName">{{$toUser->Name}}</span>
           @endif
        </div>
        <div class="messages-con">
        @if($messages)
            @foreach($messages as $message)
            @if($message->userId==$toUser->id)
            <div class="recived">
            <span>{{$message->message}}</span>
            </div>
            @endif
            @if($message->userId!=$toUser->id)
            <div class="sent">
            <span>{{$message->message}}</span>
            </div>
            @endif
            @endforeach
            @endif          
        </div>
        <form action="/send/{{$toUser->id}}" method="POST" class="msg-input-btn">
            @csrf
            <input type="text" placeholder="Type here....." name="message" 
            class="message-input">
            <button class="send-btn">Send</button>
        </form>
    </div>
</body>
</html>