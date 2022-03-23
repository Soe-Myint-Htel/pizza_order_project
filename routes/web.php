<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if(Auth::check()){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin#profile');
        }else if(Auth::user()->role == 'user'){
            return redirect()->route('user#index');
        }
    }
})->name('dashboard');

Route::group(['prefix'=>'admin'],function(){
    Route::get('profile','AdminController@profile')->name('admin#profile');

    Route::get('category','AdminController@category')->name('admin#category');
    Route::get('addCategory', 'AdminController@addCategory')->name('admin#addCategory');
    Route::post('createCategory', 'AdminController@createCategory')->name('admin#createCategory');

    Route::get('pizza','AdminController@pizza')->name('admin#pizza');
});
Route::group(['prefix'=>'user'],function(){
    Route::get('/','UserController@index')->name('user#index');
});