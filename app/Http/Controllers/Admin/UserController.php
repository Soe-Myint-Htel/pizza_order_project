<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user list
    public function userList(){
        $userData = User::where('role','user')->paginate(4);
        return view('admin.user.userList')->with(['user'=>$userData]);
    }

    // admin list
    public function adminList(){
        $userData = User::where('role','admin')->paginate(4);
        return view('admin.user.adminList')->with(['admin'=>$userData]);
    }

    // user account search
    public function userSearch(Request $request){
        $response = $this->search($request->search,'user',$request);
        return view('admin.user.userList')->with(['user'=>$response]);
    }

    // user delete
    public function userDelete($id){
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'User deleted successfully...']);
    }

    public function userEdit($id){
        $userData = User::where('id', $id)->first();
        return view('admin.user.userEdit')->with(['user'=>$userData]);
    }

    public function userEditUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'role' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        };

        $updateData = $this->requestUserData($request);
        User::where('id',$id)->update($updateData);
        return back()->with(['updateSuccess'=>'User information updated successfully']);
    }


    // admin search
    public function adminSearch(Request $request){
        $response = $this->search($request->search,'admin',$request);
        return view('admin.user.adminList')->with(['admin'=>$response]);
    }

    // admin delete
    public function adminDelete($id){
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'Admin deleted successfully...']);
    }

    private function requestUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
        ];
    }



    // data searching
    private function search($key, $role, $request){
        $searchData = User::where('role',$role)
                            ->where(function ($query) use($key) {
                                $query->orwhere('name','like','%'.$key.'%')
                                ->orWhere('email','like','%'.$key.'%')
                                ->orWhere('phone','like','%'.$key.'%')
                                ->orWhere('address','like','%'.$key.'%');
                            })
                            ->paginate(4);
        $searchData->appends($request->all());
        return $searchData;
    }
}
