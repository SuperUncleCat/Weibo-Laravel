<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct(){
      $this->middleware('auth',[
        'except'=>['show','create','store','index','confirmEmail']
      ]);

      $this->middleware('guest',[
        'only'=>['create']
      ]);
    }

    public function index(){
      $users=User::paginate(10);
      return view('users.index',compact('users'));
    }

    public function create(){
      return view('users.create');
    }

    public function show(User $user){
      return view('users.show',compact('user'));
    }

    public function store(Request $request){
      $this->validate($request,[
        'name'=>'required|max:50',
        'email'=>'required|email|unique:users|max:225',
        'password'=>'required|confirmed',
        'password_confirmation'=>'required'
      ]);

      $user=User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>bcrypt($request->password),
      ]);

      //Auth::login($user);
      $this->sendEmailConfirmationTo($user);
      //session()->flash('success','Welcome,you will have a new trip');
      session()->flash('success','Confirmation email has sent to you email address!');
      //return redirect()->route('users.show',[$user]);
      return redirect('/');
    }

    public function edit(User $user){
      $this->authorize('update',$user);
      return view('users.edit',compact('user'));
    }

    public function update(User $user,Request $request){
      $this->validate($request,[
        'name'=>'required|max:50',
        'password'=>'nullable|confirmed|min:6'
      ]);

      $this->authorize('update',$user);

      $data=[];
      $data['name']=$request->name;
      if($request->password){
        $data['password']=bcrypt($request->password);
      }
      $user->update($data);

      session()->flash('success','Update successfully!');

      return redirect()->route('users.show',$user->id);
    }

    public function destroy(User $user){
      $this->authorize('destroy',$user);
      $user->delete();
      session()->flash('success','Delete successfully!');
      return back();
    }

    protected function sendEmailConfirmationTo($user){
      $view='emails.confirm';
      $data=compact('user');
      $from='h-zhang@junction.tokyo';
      $name='Admin';
      $to=$user->email;
      $subject="Thank you for signing!";

      Mail::send($view,$data,function($message) use ($from,$name,$to,$subject){
        $message->from($from,$name)->to($to)->subject($subject);
      });
    }

    public function confirmEmail($token){
      $user=User::where('activation_token',$token)->firstOrFail();

      $user->activated=true;
      $user->activation_token=null;
      $user->save();

      Auth::login($user);
      session()->flash('success','Congratulations!');
      return redirect()->route('users.show',[$user]);
    }
}
