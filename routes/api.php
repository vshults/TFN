<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'admin',
], function () {
    //Categoryes
    Route::get('/categoryes/list', 'App\Http\Controllers\Admin\CategoryesController@index');
    Route::patch('/categoryes/list', 'App\Http\Controllers\Admin\CategoryesController@update');
    Route::post('/categoryes/list', 'App\Http\Controllers\Admin\CategoryesController@store');
    Route::delete('/categoryes/list', 'App\Http\Controllers\Admin\CategoryesController@destroy');
    Route::get('/categoryes/list/{id}', 'App\Http\Controllers\Admin\CategoryesController@show');
    //Products
    Route::get('/products/list', 'App\Http\Controllers\Admin\ProductsController@index');
    Route::post('/products/list/image', 'App\Http\Controllers\Admin\ProductsController@uploadImage');
    Route::post('/products/list', 'App\Http\Controllers\Admin\ProductsController@store');
    Route::get('/products/list/add', 'App\Http\Controllers\Admin\ProductsController@formStore');
    Route::patch('/products/list', 'App\Http\Controllers\Admin\ProductsController@update');
    Route::delete('/products/list', 'App\Http\Controllers\Admin\ProductsController@destroy');
    Route::get('/products/list/{id}', 'App\Http\Controllers\Admin\ProductsController@show');
});
