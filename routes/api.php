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

//Route::get('order', 'OrderController@show');
Route::apiResource('orders', 'OrderController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::apiResource('restaurants', 'RestoController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::apiResource('categories', 'CategoryController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
Route::apiResource('meals', 'MealController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

Route::post('register','AuthController@register');
Route::post('login','AuthController@login');

Route::get('images/{type}/{id}','ImageController@fetch');
Route::get('meals/search','MealController@search');