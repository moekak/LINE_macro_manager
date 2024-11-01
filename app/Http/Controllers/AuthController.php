<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view("auth.login");
    }


    public function login(Request $request){
        $credentials = $request->validate([
            "name" => ["required"],
            "password" => ["required"]
        ], [
            "name.required" => "ユーザーネームは必須です。",
            "password.required" => "パスワードは必須です。"
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended("/");
        }

        return back()->withErrors([
            "name" => "ユーザーネームまたはパスワードが正しくありません",
        ])->onlyInput("name");

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
