<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //admin home page
    public function index(){
        return view('admin.home');
    }
}
