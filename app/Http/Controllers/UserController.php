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

    public function searchPizzaItem(Request $request){
        $min = $request->minPrice;
        $max = $request->maxPrice;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $query = Pizza::select('*');

        if(!is_null($startDate)  && is_null($endDate)){
            $query = $query->where('created_at', '>=', $startDate);
        }elseif(is_null($startDate) && !is_null($endDate)){
            $query = $query->where('created_at', '<=', $endDate);
        }elseif(!is_null($startDate) && !is_null($endDate)){
            $query = $query->where('created_at', '>=', $startDate)
                            ->where('created_at', '<=', $endDate);
        }



        if(!is_null($min)  && is_null($max)){
            $query = $query->where('price', '>=',$min);
        }elseif(is_null($min) && !is_null($max)){
            $query = $query->where('price', '<=', $max);
        }elseif(!is_null($min) && !is_null($max)){
            $query = $query->where('price', '>=', $min)
                            ->where('price', '<=', $max);
        }
        $query = $query->paginate(3);
        $query->appends($request->all());
        $category = Category::get();
        $status = count($query) == 0? 0 : 1 ;
        return view('user.home')->with(['pizza'=>$query,'category'=>$category,'status'=>$status]);
    }
}
