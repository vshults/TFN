<?php

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

//Categoryes
Route::get('/categoryes/list', 'App\Http\Controllers\Catalog\CategoryesController@index');
Route::get('/categoryes/list/{id}', 'App\Http\Controllers\Catalog\CategoryesController@show');
//Products
Route::get('/products/list', 'App\Http\Controllers\Catalog\ProductsController@index');
Route::get('/products/list/{id}', 'App\Http\Controllers\Catalog\ProductsController@show');
