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


Route::get('/novo-post', 'App\Http\ControllersVue\PostApiController@novo');
Route::get('/lista-posts', 'App\Http\ControllersVue\PostApiController@lista');
Route::get('/post/{id}', 'App\Http\ControllersVue\PostApiController@show');
Route::post('/insert-post', 'App\Http\ControllersVue\PostApiController@insert');
Route::post('/insert-post02', 'App\Http\ControllersVue\PostApiController@salvarDB');
Route::post('/upload', 'App\Http\ControllersVue\PostApiController@ajaxImageUploadPost');
Route::put('/update-post', 'App\Http\ControllersVue\PostApiController@update');
Route::delete('/destroy-post/{id}', 'App\Http\ControllersVue\PostApiController@destroy');
