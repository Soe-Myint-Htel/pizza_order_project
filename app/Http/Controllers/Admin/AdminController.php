<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    ///admin home page
    public function profile(){
        $id = auth()->user()->id;
        $userData = User::where('id', $id)->first();
        return view('admin.profile.index')->with(['user'=>$userData]);
    }

    // update profile
    public function updateProfile($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
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

    // change password
    public function changePassword($id, Request $request){
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        };
        // get password from database
        $data = User::where('id',$id)->first();
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        $confirmPassword = $request->confirmPassword;
        $hashedPassword = $data['password'];

        if (Hash::check($oldPassword, $hashedPassword)) {
            if($newPassword != $confirmPassword){
                return back()->with(['notSame'=>'New password and  confirm password do not match...']);
            }else{
                if(strlen($newPassword) <= 7 || strlen($confirmPassword) <= 7){
                    return back()->with(['lengthError'=>'Password must be at least 8 characters...']);
                }else{
                    $hashed = Hash::make($newPassword);
                    User::where('id', $id)->update([
                        'password'=>$hashed,
                    ]);
                    return back()->with(['success'=>'Password changed successfully..']);
                }
            }
        }else{
            return back()->with(['matchError'=>'Old password do not match! try again...']);
        }
    }

    // change password page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    private function requestUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
}
