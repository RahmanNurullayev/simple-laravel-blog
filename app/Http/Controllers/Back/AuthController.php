<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Admin;
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
    public function login(){
        return view('back.auth.login');
    }
    public function loginPost(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
        //toastr()->success('Təkrar xoş gəldin '.Auth::user()->name);    
        return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors('Email adresi və ya şifrə yanlış !');
    }
   public function logout(){
       Auth::logout();
       return redirect()->route('admin.login');
   } 
}