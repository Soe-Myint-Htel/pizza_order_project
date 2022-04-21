<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;


Route::post('login', 'AuthController@login');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function () {
    return User::all();
});
// Route::group(['middleware'=>'auth:sanctum'], function(){
//     Route::get('user', function(){
//         return User::all();
//     });
// });



Route::group(['prefix'=>'category', 'namespace'=>'API', 'middleware'=>'auth:sanctum'], function(){
    Route::get('list', 'ApiController@categoryList');
    Route::post('create', 'ApiController@categoryCreate');
    Route::get('details/{id}', 'ApiController@categoryDetails');
    Route::get('delete/{id}', 'ApiController@categoryDelete');
    Route::post('update', 'ApiController@categoryUpdate');
});