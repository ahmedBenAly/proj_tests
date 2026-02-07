<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="main-log-con">
        <span class="log-t">Login</span>
        <form action="/login" method="POST" class="log-f-con">
            @csrf
            <input type="text" placeholder="ID...." name="ID" class="ID" value="{{old('ID')}}">
            <input type="password" placeholder="Password...." name="pass" class="pass" 
             value="{{old('pass')}}" >
            <button class="log-b">Go</button>
            <a  class="log-a" href="/signup">NewAccount</a>
            @error('err')
            <span class="log-err">{{$message}}</span>
            @enderror
        </form>
    </div>
</body>
</html>