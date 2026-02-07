<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function toSignUp(){
        return view('registration.signup');
    }

    public function toLogIn(){
        return view('registration.login');
    }


    public function firtsRoute(){
        if(auth()->check()){
            return redirect()->route('home');
        }else{
            return redirect()->route('login');
        }
    }

    public function homeRoute(){
        
        $tasks = Auth::user()->tasks;

        return view('userScreens.home',['tasks' => $tasks]);
    }

    public function signUp(Request $req){
        $data = Validator::make($req->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email',
            'pass' => 'required|confirmed|min:8',
            'pass_confirmation' => 'required'
        ],[
            'name.required' => '**الحقل مطلوب',
            'email.required'=> '**الحقل مطلوب',
             'email.email' =>'تنسيق ايميل خاطئ',
            'pass.required' => '**الحقل مطلوب',
            'pass.min' => '**كلمة المرور اقل من 8 احرف',
            'pass_confirmation.required' => '**الحقل مطلوب',
            'pass.confirmed' => 'تأكد من تتطابق كلمة المرور'
        ]);

        if($data->fails()){
            return redirect()->back()->withErrors($data)->withInput();
        }else{
            $res = $data->validated();
            $id = Str::random(8);

            User::create([
                'name' => $res['name'],
                'email' => $res['email'],
                'pass' => $res['pass'],
                'U_ID' => $id
            ]);

            return view('ok',['id' => $id]);
        }

        
    }

    public function logIn(Request $req){
        
        $err="";
        $pass=$req->input('pass');

        $user = User::where('U_ID',$req->input('ID'))->first();
        if(!$user){
            $err = "الحساب غير موجود";
            return redirect()->back()->withErrors(['err'=>$err])->withInput();
        }else{
            if($user->pass !== $pass){
              $err="كلمة المرور خطأ";
              return redirect()->back()->withErrors(['err'=>$err])->withInput();
            }
            else{
                Auth::login($user);
                $req->session()->regenerate();
                return redirect()->route('home');
            }
        }
    }

    public function logOut(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect()->route('main');
    }

    public function addTask(Request $req){
        $title = $req->input('task_title');

        if($title){
            Auth::user()->tasks()->create([
                'title'=>$title,
                'isDone'=>false
            ]);

            return redirect()->route('home');
        }else{
            return redirect()->back()->withErrors(['err'=>'اسم المهمة فارغt']);
        }
    }

    public function deleteTask($id){
        Auth::user()->tasks()->where('id',$id)->delete();
        return redirect()->back();
    }

    public function updateT($id){

        $task = Auth::user()->tasks()->findOrFail($id);

        $task->isDone = !$task->isDone;

        $task->save();

        return redirect()->back();

    }
}
