<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //admin home page
    public function profile(){
        $id = auth()->user()->id;
        $userData = User::where('id', $id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }
    public function category(){
        $data = Category::paginate(3);
        return view('admin.category.list')->with(['category' => $data]);
    }
    // add category
    public function addCategory(){
        return view('admin.category.addCategory');
    }

    // delete category
    public function delete($id){
        Category::where('category_id', $id)->delete();
        return back()->with(['successDelete'=>'Categroy deleted successfully']);
    }

    // edit category
    public function edit($id){
        $data = Category::where('category_id', $id)->first();
        return view('admin.category.edit')->with(['category'=>$data]);
    }

    // update category
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateDate = [
            'category_name' => $request->name,
        ];
        Category::where('category_id', $request->id)->update($updateDate);
        return redirect()->route('admin#category')->with(['successUpdate'=>'Category updated successfully']);
    }

    public function createCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = ['category_name' => $request->name];
        Category::create($data);
        return redirect()->route('admin#category')->with(['successCategory' => 'Category added successfully...']);
    }
    

    public function pizza(){
        return view('admin.pizza.list');
    }
}
