<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Messages;
use Illuminate\Support\Facades\Validator;


class PagesController extends Controller
{
    public function initPage(){
        if(Auth::check())
         return redirect()->route('userScreen');
        else  
          return redirect()->route('login');
    }

    public function signupScreen(){
        return view('signup');
    }

    public function loginScreen(){
        return view('registration');
    }

    public function userScreen(){
        $all = User::all();

        return view('userScreen',['users'=>$all]);
    }

    private function validateUserInputs(
        Request $req,
        $onValid
        ){
        $data = Validator::make($req->all(),[
            'name' => 'required|min:3',
            'pass' => 'required|min:8'
        ],[
            'name.required' => "أدخل اسم المستخدم!",
            'name.min' => "اسم المستخدم قصير جدا",
            'pass.required' => 'أدخل كلمة المرور',
            'pass.min' => 'كلمة المرور قصيره جدا'
        ]);

        if($data->fails()){
            return redirect()->back()->withErrors($data)->withInput();
        }
        else return $onValid($data->validated());   
    }


    public function login(Request $req){

        return $this->validateUserInputs($req,function($data) use ($req){
            
            $user = User::where('name',$data['name'])->first();

            if(!$user)
              return redirect()->back()->withErrors(['err'=>'المستخدم غير موجود'])->withInput();
            else{
                
                 Auth::login($user);
                $req->session()->regenerate();
                return redirect()->route('userScreen');
            }
        });

    }

   

    public function newAcc(Request $req){
        return $this->validateUserInputs($req,function($data){
            $user = User::where('name',$data['name'])->first();

            if($user)
              return redirect()->back()->withErrors(['err'=>'اسم المستخدم موجود بالفعل'])->withInput();
            else{

                $isAccCreated = User::create([
                    'name'=>$data['name'],
                    'password'=>bcrypt($data['pass'])
                ]);

                if($isAccCreated)
                 return redirect()->back()->withErrors(['err'=>'تم إنشاء الحساب']);
                else                  
                 return redirect()->back()->withErrors(['err'=>'حدث خطأ اثناءإنشاء الحساب'])->withInput();
            }
             
        });
    }

    public function logOut(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('initPage');
    }


    public function chatwith($id){

        $toUser = User::where('id',$id)->first();

        $messages = Messages::where([
            ['userId','=',Auth::id()],
            ['to','=', $id]
        ])->orWhere([
            ['userId' ,'=', $id],
            ['to' ,'=', Auth::id()]
        ])->orderBy('created_at', 'asc') 
        ->get();


       
        

        return view('chatscreen',[
            'toUser'=>$toUser,
            'messages'=>$messages,
        ]);

    }

    public function sendMessage(Request $req,$id){

        $toUser = User::where('id',$id)->first();
        
        if($toUser){
            $isMessageSent = Messages::create([
                'userId' =>Auth::id(),
                'to' => $toUser->id,
                'message' => $req->input('message')
            ]);

            if($isMessageSent){
                return redirect()->route('chatscreen',['id'=>$id]);
            }else{
                return redirect()->back()->withErrors(['err'=>'حدث خطأ']);
            }
        }else{
            return redirect()->back()->withErrors(['err'=>'حدث خطأ']);
        }
    }
}
