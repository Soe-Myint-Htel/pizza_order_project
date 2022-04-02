<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // user list
    public function userList(){
        $userData = User::where('role','user')->get();
        return view('admin.user.userList')->with(['user'=>$userData]);
    }

    // admin list
    public function adminList(){
        $userData = User::where('role','admin')->get();
        return view('admin.user.adminList')->with(['user'=>$userData]);
    }
}
