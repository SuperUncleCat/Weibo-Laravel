<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class UsersController extends Controller
{
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

      session()->flash('success','Welcome,you will have a new trip');
      return redirect()->route('users.show',[$user]);
    }
}
