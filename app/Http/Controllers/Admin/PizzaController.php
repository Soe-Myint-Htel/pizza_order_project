<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    public function pizza(){
        $data = Pizza::paginate(3);
        return view('admin.pizza.list')->with(['pizza' => $data]);
    }

    // create pizza
    public function createPizza(){
        $category = Category::get();
        return view('admin.pizza.create')->with(['category' => $category]);
    }

    // insert pizza
    public function insertPizza(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'publish' => 'required',
            'category' => 'required',
            'discount' => 'required',
            'buyOneGetOne' => 'required',
            'waitingTime' => 'required',
            'description' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        };
        // image store
        $file = $request->file('image');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/uploads', $fileName);

        $data = $this->requestPizza($request, $fileName);
        Pizza::create($data);
        return redirect()->route('admin#pizza')->with(['successPizza' => 'Pizza created successfully']);
    }

    // delete pizza 
    public function deletePizza($id){
        Pizza::where('pizza_id', $id)->delete();
        return back()->with(['deletePizza' => 'Pizza deleted successfully']);
    }


    private function requestPizza($request, $fileName){
        return [
            'pizza_name' => $request->name,
            'image' => $fileName,
            'price' => $request->price,
            'public_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'waiting_time' => $request->waitingTime,
            'description' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
