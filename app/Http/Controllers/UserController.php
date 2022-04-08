<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //user home page
    public function index(){
        $pizza = Pizza::where('public_status',1)->get();
        $category = Category::get();
        return view('user.home')->with(['pizza'=>$pizza,'category'=>$category]);
    }

    public function pizzaDetails($id){
        $data = Pizza::where('pizza_id',$id)->first();
        return view('user.details')->with(['pizza'=>$data]);
    }

    public function categorySearch($id){
        $data = Pizza::where('category_id', $id)->get();
        $category = Category::get();
        return view('user.home')->with(['pizza'=>$data,'category'=>$category]);
    }
}
