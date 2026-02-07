<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body class="user-s-body">
    <div class="user-s-con">
        <div class="title-logout">
        @auth
        <span class="username"> Hi {{ auth()->user()->Name }}</span>
        @endauth

        <form action="/logout" method="POST">
            @csrf
            <button class="logout">Logout</button>
        </form>
        </div>
        <span class="chatwith">Chat with:</span>

        <div class="chats-con">
            @if($users)
            @foreach($users as $user)
             @if($user->id !== auth()->user()->id)
             <form action="/chatwith/{{$user->id}}" method="GET" class="user-item">
                @csrf
                <button class="user-name-item">{{$user->Name}}</button>
             </form>
             @endif
            @endforeach
            @endif
        </div>
    </div>
</body>
</html>