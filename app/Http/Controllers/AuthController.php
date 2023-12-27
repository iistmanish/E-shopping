<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(){
        return view('register');
    }

    public function registerPost(Request $request){
        $user = new User();

        $user->name =$request->name;
        $user->email =$request->email;
        $user->password =Hash::make($request->password);

        $user->save();
        return back()->with('success','Register Successfully');
    }

    public function login(){
        return view('login');
    }

    public function loginPost(Request $request){
      $credentials = [
        'email' =>$request->email,
        'password' =>$request->password,
      ];

      if(Auth::attempt($credentials)){
        return redirect('/shopping/admin')->with('success','Login Successfully');
      }
      return back()->with('error','Email or Password Invalid');
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function index(){
      return view('admin');
  }
}