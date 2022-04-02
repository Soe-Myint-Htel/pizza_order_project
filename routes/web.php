<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PizzaController;

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

Route::group(['prefix'=>'admin', 'namespace'=>'Admin'],function(){
    Route::get('profile','AdminController@profile')->name('admin#profile');

    Route::post('update/{id}', 'AdminController@updateProfile')->name('admin#updateProfile');
    Route::get('changePassword', 'AdminController@changePasswordPage')->name('admin#changePasswordPage');
    Route::post('changePassword/{id}', 'AdminController@changePassword')->name('admin#changePassword');

    Route::get('category','CategoryController@category')->name('admin#category');
    Route::get('addCategory', 'CategoryController@addCategory')->name('admin#addCategory');
    Route::post('createCategory', 'CategoryController@createCategory')->name('admin#createCategory');
    Route::get('deleteCategory/{id}','CategoryController@delete')->name('admin#deleteCategory');
    Route::get('editCategory/{id}','CategoryController@edit')->name('admin#editCategory');
    Route::post('updateCategory','CategoryController@update')->name('admin#updateCategory');
    Route::get('category/search','CategoryController@search')->name('admin#searchCategory');

    Route::get('pizza','PizzaController@pizza')->name('admin#pizza');
    Route::get('createPizza', 'PizzaController@createPizza')->name('admin#createPizza');
    Route::post('insertPizza', 'PizzaController@insertPizza')->name('admin#insertPizza');
    Route::get('deletePizza/{id}', 'PizzaController@deletePizza')->name('admin#deletePizza');
    Route::get('infoPizza/{id}', 'PizzaController@infoPizza')->name('admin#infoPizza');
    Route::get('editPizza/{id}', 'PizzaController@editPizza')->name('admin#editPizza');
    Route::post('updatePizza/{id}', 'PizzaController@updatePizza')->name('admin#updatePizza');
    Route::get('pizza/search', 'PizzaController@searchPizza')->name('admin#searchPizza');
    
    Route::get('userList', 'UserController@userList')->name('admin#userList');
    Route::get('adminList', 'UserController@adminList')->name('admin#adminList');
    Route::get('userList/search', 'UserController@userSearch')->name('admin#userSearch');
    Route::get('userList/delete/{id}', 'UserController@userDelete')->name('admin#userDelete');
});
Route::group(['prefix'=>'user'],function(){
    Route::get('/','UserController@index')->name('user#index');
});
