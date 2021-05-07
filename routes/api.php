<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MenuController;


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


Route::get('/menu', 'App\Http\Controllers\Api\MenuController@index');
Route::get('/menu/item', 'App\Http\Controllers\Api\MenuItemController@index');
Route::get('/menu/item/category', 'App\Http\Controllers\Api\CategoryController@index');
