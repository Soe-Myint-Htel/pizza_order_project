<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    
    public function category(){
        $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id)as count'))
                ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
                ->groupBy('categories.category_id')
                ->paginate(3);
        // dd($data->toArray());

        // $data = Category::select('categories.*',DB::raw('COUNT(pizzas.category_id)as count'))
        //         ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
        //         ->groupBy('categories.category_id')
        //         ->get();
        // dd($data->toArray());
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
        $data = Category::where('category_name', 'like', '%'.$request->search.'%')->paginate(3);
        $data->appends($request->all());
        return view('admin.category.list')->with(['category' => $data]);
    }

    // category item
    public function categoryItem($id){
        $data = Pizza::select('pizzas.*','categories.category_name as categroyName')
                        ->join('categories','categories.category_id','pizzas.category_id')
                        ->where('pizzas.category_id',$id)
                        ->paginate(3);
        return view('admin.category.item')->with(['pizza'=>$data]);
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
