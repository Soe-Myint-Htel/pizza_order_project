<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    
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

    // search category
    public function search(Request $request){
        $data = Category::where('category_name', 'like', '%'.$request->search.'%')->paginate(2);
        return view('admin.category.list')->with(['category' => $data]);
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
}
