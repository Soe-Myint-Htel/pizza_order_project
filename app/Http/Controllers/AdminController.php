<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //admin home page
    public function profile(){
        $id = auth()->user()->id;
        $userData = User::where('id', $id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }
    public function category(){
        return view('admin.category.list');
    }
    // add category
    public function addCategory(){
        return view('admin.category.addCategory');
    }
    public function createCategory(Request $request){
        $data = ['category_name' => $request->name];
        Category::create($data);
        return redirect()->route('admin#category')->with(['successCategory' => 'Category added successfully...']);
    }
    

    public function pizza(){
        return view('admin.pizza.list');
    }
}
