<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="main-sign-con">
        <span class="sign-t">Join Us Now</span>
        <form action="/signup" method="post" class="sign-f-con">
            @csrf
            <div class="sign-i-err">
              <input type="text" placeholder="Username...." name='name' class="sign-i"
              value="{{old('name')}}" >
              @error('name')
              <span class="err">{{ $message }}</span>
              @enderror
            </div>

            <div class="sign-i-err">
            <input type="text" placeholder="Email...." name='email' class="sign-i"
            value="{{old('email')}}">
            @error('email')
            <span class="err">{{ $message }}</span>
            @enderror
            </div>

            <div class="sign-i-err">
            <input type="password" placeholder="Password...." name='pass' class="sign-i"
            value="{{old('pass')}}" >
            @error('pass')
            <span class="err">{{ $message }}</span>
            @enderror
            </div>

            <div class="sign-i-err">
                    
            <input type="password" placeholder="Confirm_password...." name='pass_confirmation'
            class="sign-i"
            value="{{old('pass_confirmation')}}"
            >
            @error('pass')
            <span class="err">{{ $message }}</span>
            @enderror
            </div>
            <button class="join">Join</button>
            <a href="/login" class="login" >Login?</a>
        </form>
    </div>
</body>
</html>