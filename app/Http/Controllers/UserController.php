<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        Session::put('PIZZA_INFO', $data); //session to order page
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

    public function order(){
        $pizzaInfo = Session::get('PIZZA_INFO'); //session from details
        return view('user.order')->with(['pizza'=>$pizzaInfo]);
    }

    public function placeOrder(Request $request){
        $pizzaInfo = Session::get('PIZZA_INFO');
        $userID = Auth()->user()->id;
        $count = $request->pizzaCount;

        $validator = Validator::make($request->all(), [
            'pizzaCount' => 'required',
            'paymentType' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $orderData = $this->requestOrderData($pizzaInfo, $userID, $request);
        for($i=0; $i<$count; $i++){
            Order::create($orderData);
        }

        $waitingTime = $pizzaInfo['waiting_time'] * $count;
        return back()->with(['totalTime'=>$waitingTime]);
    }



    private function requestOrderData($pizzaInfo, $userID, $request){
        return [
            'customer_id'=>$userID,
            'pizza_id'=>$pizzaInfo['pizza_id'],
            'deliver_id'=>0,
            'payment_status'=>$request->paymentType,
            'order_time'=>Carbon::now(),
        ];
    }
}
