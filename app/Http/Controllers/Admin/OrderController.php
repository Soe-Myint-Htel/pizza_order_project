<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderList(){
        $data = Order::select('orders.*', 'users.name as customer_name', 'pizzas.pizza_name as pizza_name', DB::raw('COUNT(orders.pizza_id) as count'))
                ->join('users', 'users.id', 'orders.customer_id')
                ->join('pizzas', 'pizzas.pizza_id', 'orders.pizza_id')
                ->groupBy('orders.customer_id', 'orders.pizza_id')
                ->paginate(3);
                
        return view('admin.order.list')->with(['order'=>$data]);
    }

    public function orderSearch(Request $request){
        $data = Order::select('orders.*', 'users.name as customer_name', 'pizzas.pizza_name as pizza_name', DB::raw('COUNT(orders.pizza_id) as count'))
                ->join('users', 'users.id', 'orders.customer_id')
                ->join('pizzas', 'pizzas.pizza_id', 'orders.pizza_id')
                ->orWhere('users.name', 'like', '%'.$request->search.'%')
                ->orWhere('pizzas.pizza_name', 'like', '%'.$request->search.'%')
                ->groupBy('orders.customer_id', 'orders.pizza_id')
                ->paginate(3);

        $data->appends($request->all());
        return view('admin.order.list')->with(['order'=>$data]);
    }
}
