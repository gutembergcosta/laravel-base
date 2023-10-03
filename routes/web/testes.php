<?php

//Route::get('/teste-pdf', 'App\Http\Controllers\PostController@novo')->name('teste-mpdf');


Route::get('teste-carbon', 'App\Http\Controllers\TestesController@testeCarbon');
Route::get('teste-mpdf', 'App\Http\Controllers\TestesController@testeMpdf');
Route::get('teste-email', 'App\Http\Controllers\TestesController@testeEmail');
Route::get('painel/megaform', 'App\Http\Controllers\TestesController@megaform')->name('item.megaform');
Route::get('painel/modal-base', 'App\Http\Controllers\TestesController@modal')->name('teste.modal');


