<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    public function categoryList(){
        $category = Category::get();
            $response = [
                "status" => "success",
                "data" => $category,
            ];
        return Response::json($response);
    }

    public function categoryCreate(Request $request){
        $data = [
            'category_name' => $request->categoryName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Category::create($data);

        return Response::json([
            "status"=>200,
            "message"=>"success"
        ]);
    }

    public function categoryDetails($id){
        $data = Category::where('category_id', $id)->first();

        if(!empty($data)){
            return Response::json([
                "status"=>200,
                "message"=>"success",
                "data"=>$data,
            ]);
        }

        return Response::json([
            "status"=>400,
            "message"=>"fail",
            "data"=>$data,
        ]);
    }

    public function categoryDelete($id){
        $data = Category::where('category_id', $id)->first();

        if(empty($data)){
            return Response::json([
                "status"=>400,
                "message"=>"No such data in the table",
            ]);
        }

        Category::where('category_id', $id)->delete($data);

        return Response::json([
            "status"=>200,
            "message"=>"success",
        ]);
    }

}
