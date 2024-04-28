<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FacegramController extends Controller
{

    public function userIndex(){
        $user = User::all();

        $data = [
            'message' => 'berhsil mengambil data user',
            'body' => $user

        ];


        return response()->json($data);


    }


    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'bio' => 'required|max:100',
            'username' => 'required|min:3|unique:users,username',
            'password' => 'required|min:6',
            'is_private' => 'in:1,0'
        ]);

        $user = User::create([
            'full_name' => $request->input('full_name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'bio' => $request->input('bio'),
            'is_private' => $request->input('is_private'),
        ]);


        $data = [
            'message' => 'register success',
            'user' => $user
        ];

        return response()->json($data);

    }
}
