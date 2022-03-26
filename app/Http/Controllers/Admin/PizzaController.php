<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function pizza(){
        return view('admin.pizza.list');
    }

    // create pizza
    public function createPizza(){
        return view('admin.pizza.create');
    }
}
