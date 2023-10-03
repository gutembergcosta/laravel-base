<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;


class PasswordResetTest extends TestCase
{


    public function test_pagina_novo_cadastro_é_visivel_para_todos()
    {
        $response = $this->get(route('nova-senha.solicitar'));
        $response->assertSuccessful();
    }

    public function test_somente_usuarios_autorizados_podem_solicitar_nova_senha()
    {
        Notification::fake(); 

        $response = $this->post(route('nova-senha.enviar-token'), [
            'email'     => 'user@email.com.br',
        ]);

        $response->assertStatus(200); 

    }

    public function test_usuarios_nao_autorizados_nao_podem_solicitar_nova_senha(){

        $response = $this->post(route('nova-senha.enviar-token'), [
            'email'     => 'pendente@email.com.br',
        ]);
        $response->assertStatus(422); 

    }

  
    public function test_token_valido_é_obrigatorio_para_alterarSenha(){
        $token = mdx('user@email.com.br|'.Carbon::now()->addHours(4).'|'.rand(1,99));
        $response = $this->post(route('nova-senha.salvar'), [
            'token' => $token,
            'password' => '01020304',
        ]);
        $response->assertStatus(200);
    }

    /*

    
    
    
    public function test_token_com_mais_de_4_horas_nao_pode_alterar_senha(){}

    Route::prefix('nova-senha')->group(function(){
        Route::get('solicitar', 'App\Http\Controllers\Auth\PasswordResetController@solicitar')->name('nova-senha.solicitar');
        Route::get('redefinir', 'App\Http\Controllers\Auth\PasswordResetController@redefinir')->name('nova-senha.redefinir');
        Route::post('enviar-token', 'App\Http\Controllers\Auth\PasswordResetController@enviar')->name('nova-senha.enviar-token');
        Route::post('salvar', 'App\Http\Controllers\Auth\PasswordResetController@salvar')->name('nova-senha.salvar');
    });


    /*
    public function test_qualquer_pessoa_pode_se_cadastrar()
    {
        Notification::fake(); 

        $response = $this->post('/cadastro/salvar', [
            'name'      => 'fulano '.rand(4,6),
            'email'     => 'user@email.com.br',
			'password'  => '0102',
        ]);


        $response->assertStatus(422); 

    }*/
    

    
    /*
    
    test_não_deve_ser_possivel_se_cadastrar_com_email_já_exstente
    */

    
}
