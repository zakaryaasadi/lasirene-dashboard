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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/services/ladies/{ln}/{page}','ServiceApiController@ladies');

Route::get('/services/gents/{ln}/{page}','ServiceApiController@gents');

Route::get('/news/{ln}/{page}','NewsApiController@get');

Route::get('/customers/login/{email}/{password}','CustomerApiController@login');

Route::get('/customers/change/{id}/{email}/{password}/{full_name}/{phone}','CustomerApiController@change');

Route::get('/customers/signup/{full_name}/{email}/{password}/{phone}/{gender}/{date_of_birth}','CustomerApiController@signup');

Route::get('/products/{service_id}/{ln}/{page}','ProductApiController@get');

Route::post('/booking','BookingApiController@add');

Route::get('/booking/{customer_id}/{page}','BookingApiController@get');

