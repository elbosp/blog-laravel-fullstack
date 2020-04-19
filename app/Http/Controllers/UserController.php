<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $credentials = [
            'email' => request()->email,
            'password' => request()->password
        ];

        if (auth()->attempt($credentials)) {
            return response()->json(auth()->user()->createToken(auth()->user()->name));
        } else {
            return response()->json(['message' => 'Email or Password may be wrong'], 401);
        }
    }

    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => bcrypt(request()->password)
        ]);

        return response()->json($user->createToken($user->name));
    }

    public function get()
    {
        return response()->json(auth()->user());
    }
}
