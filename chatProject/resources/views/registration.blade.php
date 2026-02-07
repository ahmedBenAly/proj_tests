<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body class="reg-body">
    <div class="reg-con">
        <span class="reg-title">Login</span>
        <form action="/login" method="POSt" class="reg-form">
            @csrf
            <div class='reg-input-err'>
            <input type="text" placeholder="Name....." name="name" 
            class="reg-input"
            value="{{old('name')}}"
            >
            @error('name')
           <span class='reg-err' >{{$message}}</span>
            @enderror
            </div>

            <div class='reg-input-err'>
            <input type="password" placeholder="password...." name="pass"
             class="reg-input"
             value="{{old('pass')}}"
             >
             @error('pass')
             <span class='reg-err' >{{$message}}</span>
            @enderror
            </div>

            <button class="reg-log-btn">Login</button>
            <a class="reg-sign-btn" href="/signup">New Account?</a>
        </form>
        @error('err')
        <span class='reg-err' >{{$message}}</span>
        @enderror
    </div>
</body>
</html>