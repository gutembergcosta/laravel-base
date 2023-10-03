<?php
use App\Http\Middleware\IsLogged;



Route::get('dashboard', 'App\Http\Controllers\AuthController@dashboard')->name('dashboard');
Route::get('login', 'App\Http\Controllers\Auth\LoginController@login')->middleware(IsLogged::class)->name('login');
Route::post('entrar', 'App\Http\Controllers\Auth\LoginController@entrar')->name('entrar');


Route::prefix('cadastro')->group(function(){
    Route::get('novo', 'App\Http\Controllers\Auth\RegistroController@novo')->name('cadastro.novo');
    Route::get('validar/{userToken}', 'App\Http\Controllers\Auth\RegistroController@validar')->name('cadastro.validar')->middleware(IsLogged::class);
    Route::post('salvar', 'App\Http\Controllers\Auth\RegistroController@salvar')->name('cadastro.salvar');
});

Route::prefix('nova-senha')->group(function(){
    Route::get('solicitar', 'App\Http\Controllers\Auth\PasswordResetController@solicitar')->name('nova-senha.solicitar')->middleware(IsLogged::class);
    Route::get('redefinir/{token}', 'App\Http\Controllers\Auth\PasswordResetController@redefinir')->name('nova-senha.redefinir')->middleware(IsLogged::class);
    Route::post('enviar-token', 'App\Http\Controllers\Auth\PasswordResetController@enviar')->name('nova-senha.enviar-token');
    Route::post('salvar', 'App\Http\Controllers\Auth\PasswordResetController@salvar')->name('nova-senha.salvar');
});


///////////////////////
Route::middleware(['verificaLogin'])->prefix('painel')->group(function(){
    Route::group(['middleware' => ['verificaAdmin']], function(){
        Route::prefix('item')->group(function(){
            Route::get('', 'App\Http\Controllers\Admin\ItemController@lista')->name('item.lista');
            Route::get('novo', 'App\Http\Controllers\Admin\ItemController@novo')->name('item.novo');
            Route::get('edit/{id}', 'App\Http\Controllers\Admin\ItemController@show')->name('item.edit');
            Route::get('datatable', 'App\Http\Controllers\Admin\ItemController@getDataTable')->name('item.datatable');
            Route::post('insert', 'App\Http\Controllers\Admin\ItemController@insert')->name('item.insert');
            Route::post('ajax-list', 'App\Http\Controllers\Admin\ItemController@ajaxList')->name('item.list');
            Route::put('update', 'App\Http\Controllers\Admin\ItemController@update')->name('item.update');
            Route::delete('destroy/{id}', 'App\Http\Controllers\Admin\ItemController@destroy')->name('item.delete');

        });

        Route::prefix('categorias')->group(function(){
            Route::get('', 'App\Http\Controllers\CategoriaController@lista')->name('categoria.lista');
            Route::get('novo', 'App\Http\Controllers\CategoriaController@novo')->name('categoria.novo');
            Route::get('edit/{id}', 'App\Http\Controllers\CategoriaController@show')->name('categoria.edit');
            Route::post('insert', 'App\Http\Controllers\CategoriaController@insert')->name('categoria.insert');
            Route::put('update', 'App\Http\Controllers\CategoriaController@update')->name('categoria.update');
            Route::delete('destroy/{id}', 'App\Http\Controllers\CategoriaController@destroy')->name('categoria.delete');
        });

        Route::prefix('usuarios')->group(function(){
            Route::get('', 'App\Http\Controllers\Admin\UserController@lista')->name('usuario.lista');
            Route::get('novo', 'App\Http\Controllers\Admin\UserController@novo')->name('usuario.novo');
            Route::get('edit/{id}', 'App\Http\Controllers\Admin\UserController@show')->name('usuario.edit');
            Route::post('insert', 'App\Http\Controllers\Admin\UserController@insert')->name('usuario.insert');
            Route::delete('destroy/{id}', 'App\Http\Controllers\Admin\UserController@destroy')->name('usuario.delete');
        });

        Route::get('historico', 'App\Http\Controllers\Admin\HistoricoController@lista')->name('historico');
        Route::get('home-full', 'App\Http\Controllers\PainelController@homeFull');
    });

    Route::put('usuarios/update', 'App\Http\Controllers\Admin\UserController@update')->name('usuario.update');



    Route::post('upload/', 'App\Http\Controllers\ArquivoController@insert');
    Route::delete('deletar-arquivo/{item}', 'App\Http\Controllers\ArquivoController@destroy');
    Route::get('home', 'App\Http\Controllers\PainelController@home')->name('painel.home');
    

    Route::get('perfil', 'App\Http\Controllers\Admin\UserController@perfil')->name('painel.perfil');
    Route::put('salvar-senha', 'App\Http\Controllers\Admin\UserController@salvarSenha')->name('painel.salvar-senha');

    Route::get('sair', 'App\Http\Controllers\Auth\LoginController@logout')->name('sair');
});


