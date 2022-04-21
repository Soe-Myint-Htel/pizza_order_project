<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(Request $request){
        $validation = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if(empty($user) || !Hash::check($request->password, $user->password)){
            return Response::json([
                "message"=>"do not match",
            ], 200);
        }

        $token = $user->createToken('myAppToken')->plainTextToken;
        return Response::json([
            "user" => $user,
            'token' => $token,
        ], 200);
    }
}
