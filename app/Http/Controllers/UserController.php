<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //user home page
    public function index(){
        $pizza = Pizza::where('public_status',1)->get();
        return view('user.home')->with(['pizza'=>$pizza]);
    }

    public function pizzaDetails($id){
        $data = Pizza::where('pizza_id',$id)->first();
        return view('user.details')->with(['pizza'=>$data]);
    }
}
