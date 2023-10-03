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

Route::get('/', function () {
    return view('welcome');
});

include("web/testes.php");
include("web/posts.php");
include("web/painelRotas.php");


Route::get('enviar-email', function () {
   
    $data = [
        'title' => 'Mail from teste.com',
        'body'  => 'This is for testing email using smtp'
    ];
   
    \Mail::to('gutembergcosta01@gmail.com')->send(new \App\Mail\MyTestMail($data));
   
    dd("Email enviado.");
});

Route::get('bckript', function () {
   
    echo bcrypt('olaria01');
});






