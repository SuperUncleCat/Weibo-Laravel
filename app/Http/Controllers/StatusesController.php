<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Status;
use Auth;

class StatusesController extends Controller
{
    public function __contruct(){
      $this->middleware('auth');
    }

    public function store(Request $request){
      $this->validate($request,[
        'content'=>'required|max:140'
      ]);

      Auth::user()->statuses()->create([
        'content'=>$request->content
      ]);
      return redirect()->back();
    }

    public function destroy(Status $status){
      $this->authorize('destroy',$status);
      $status->delete();
      session()->flash('success','Delete successfully!');
      return redirect()->back();
    }
}
