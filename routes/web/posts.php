<?php


Route::get('/novo-post', 'App\Http\Controllers\PostController@novo')->name('post.novo');
Route::get('/lista-posts', 'App\Http\Controllers\PostController@lista')->name('posts.lista');
Route::get('/post/{id}', 'App\Http\Controllers\PostController@show')->name('post.show');
Route::post('/insert-post', 'App\Http\Controllers\PostController@insert')->name('post.insert');
Route::put('/update-post', 'App\Http\Controllers\PostController@update')->name('post.update');
Route::delete('/destroy-post/{id}', 'App\Http\Controllers\PostController@destroy')->name('post.delete');


