<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // user list
    public function userList(){
        $userData = User::where('role','user')->paginate(4);
        return view('admin.user.userList')->with(['user'=>$userData]);
    }

    // admin list
    public function adminList(){
        $userData = User::where('role','admin')->paginate(4);
        return view('admin.user.adminList')->with(['user'=>$userData]);
    }

    // user account search
    public function userSearch(Request $request){
        $key = $request->search;
        $searchData = User::orWhere('name','like','%'.$key.'%')
                            ->orWhere('email','like','%'.$key.'%')
                            ->orWhere('phone','like','%'.$key.'%')
                            ->orWhere('address','like','%'.$key.'%')
                            ->where('role','user')
                            ->paginate(4);
        $searchData->appends($request->all());
        return view('admin.user.userList')->with(['user'=>$searchData]);
    }

    // user delete
    public function userDelete($id){
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'User deleted successfully...']);
    }
}
