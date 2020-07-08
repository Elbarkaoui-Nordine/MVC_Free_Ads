<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    public function edit(){
        
        return view('user.edit');
    }

    public function update(){
        
        $user = auth()->user();
        request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password'=> 'required|max:255',
        ]);

        $user->name = request('name');
        $user->email = request('email');
        $user->password = hash::make(request('password'));

        $user->save();

        return redirect('/profile/edit')->with('msg','Profile edited correctly');

    }

}
