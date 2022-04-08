<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //user home page
    public function index(){
        $pizza = Pizza::where('public_status',1)->paginate(9);
        $category = Category::get();
        $status = count($pizza) == 0? 0 : 1 ;
        return view('user.home')->with(['pizza'=>$pizza,'category'=>$category,'status'=>$status]);
    }

    public function pizzaDetails($id){
        $data = Pizza::where('pizza_id',$id)->first();
        return view('user.details')->with(['pizza'=>$data]);
    }

    public function categorySearch($id){
        $data = Pizza::where('category_id', $id)->paginate(9);
        $category = Category::get();
        $status = count($data) == 0? 0 : 1 ;
        return view('user.home')->with(['pizza'=>$data,'category'=>$category,'status'=>$status]);
    }

    public function searchItem(Request $request){
        $data = Pizza::where('pizza_name','like','%'.$request->searchData.'%')->paginate(9);
        $data->appends($request->all());
        $category = Category::get();
        $status = count($data) == 0? 0 : 1 ;
        return view('user.home')->with(['pizza'=>$data,'category'=>$category,'status'=>$status]);
    }
}
