<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <title>Document</title>

    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="main-con">
        <div class="tit-quit-r">
            <div class="gre-un">
            @auth
            <span class="gretting">Hi {{auth()->user()->name}}</span>
            @endauth
            </div>
             <form action="/logOut" method="POST" class="logout-f">
                @csrf
              <button class="logOut">LogOut</button>
            </form>
        </div>

        <div class="tasks-con">
               <div class="i-a-err-con">
               <form action="/addTask" method="POST" class="input-add-con">
                    @csrf
                  <input type="text" placeholder="Task_Title...." name="task_title" 
                  class="task-i">
                  <button class="add-t">Add</button>
                </form>
                @error('err')
                 <span class="err">{{ $message }}</span>
                @endif
               </div>
            <div class="tasks-l">
                @foreach($tasks as $task)
                 <div class="task-con">
                    <span class="task-t">{{$task->title}}</span>
                    <form action="/deleteT/{{$task->id}}" method="POST" class="d-t">
                        @csrf
                    <input type="checkbox" name="isDone" class="isDone"
                     onchange="window.location.href='/updateT/{{ $task->id }}'"
                    {{$task->isDone? 'checked' : ''}}
                    >
                     <button class="d-b">Delete</button>
                    </form>
                 </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>