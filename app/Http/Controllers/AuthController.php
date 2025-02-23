<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request){
       if($request->isMethod("post")){
         $request->validate([
            'username'=>['required','between:5,10'],
            'email'=>['required','email','unique:users'],
            'password'=>['required','confirmed',Password::min(8)->letters()->mixedCase()->numbers()->symbols()]
         ]);
         $user=User::create([
            'username'=>$request->input("username"),
            'email'=>$request->input("email"),
            'password'=>$request->input("password"),
         ]);

         Auth::login($user);

         return redirect()->route("home");
       }
       else if($request->isMethod("get")){
          return view("Auth.register");
       }
    }

    public function login(Request $request) {
      if($request->isMethod("post")){
          $request->validate([
            'email'=>['required','email'],
            'password'=>['required'],
          ]);


          if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
             return redirect()->route("home");
          }
          else{
            return back()->with("incorrect","Credentials does not match our records");
          }
      }
      else if($request->isMethod("get")){
         return view("Auth/login");
      }
    }
    public function logout(Request $request){
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect()->route("home");
    }
}
