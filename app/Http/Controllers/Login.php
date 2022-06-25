<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class Login extends Controller
{
    //

    public function login(){
        return view('Login.loginOuth');
    }

    public function register(){
        return view('Login.RegisterOuth');
    }

    public function user_register(Request $request){
        
        $request->validate([
            'email'=>'required|unique:users,email',
            'name'=>'required',
            'password'=>'required'
        ]);
        $email=DB::Table('users')->where('email',$request->email)->value('email');
        if($email){
            dd('tes');
        }

        $anggota= new User();
        $anggota->name = $request->name;
        $anggota->email = $request->email;
        $anggota->password = bcrypt($request->password);
        $anggota->level ='anggota';
        $anggota->save();
        
        return view('login.loginOuth');
        
    }


    public function proses_login(Request $request){
        $request->validate([
            'email'=>'required',
            'name'=>'required',
            'password'=>'required'
        ]);

        $kredensil= $request->only('email','name','password');
        if(Auth::attempt($kredensil)){
            return redirect('/diagnosa');
            //return view('login.registerOuth')->with('success','Login sucess');
        }
        return view('login.registerOuth')->with('error','Login Failed');

    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function tes(){
        
        return view('layout.dashboard');
    }
}
