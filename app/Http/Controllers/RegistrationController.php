<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegistrationController {

    public function create() {
        return view('admin/register');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'bail|required|unique:users,name|max:255',
            'email' => 'bail|required|email|unique:users,email|max:255',
            'password' => 'bail|required|unique:categories,name|min:8|max:100|confirmed',
        ]);

        $user = new \App\User;
        $user->name = $validatedData['name'];
        $user->slug = \Illuminate\Support\Str::slug($validatedData['name']);
        $user->email = $validatedData['email'];
        $user->email_verified_at = now();
        $user->password = \Illuminate\Support\Facades\Hash::make($validatedData['password']);
        $user->remember_token = \Illuminate\Support\Str::random(10);
        $user->save();

        auth()->login($user);

        return redirect('/')->with('success', "User '{$user->name}' successfully created");
    }
}
