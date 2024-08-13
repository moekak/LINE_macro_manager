<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(){
        return view("auth.signup");
    }

    public function store(SignupRequest $request){
        $validated = $request->validated();
        $validated["password"] = Hash::make($validated["password"]);
        User::create($validated);

        return redirect()->route("device")->with("success", "ユーザーを登録しました。");
    }
}
