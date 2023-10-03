<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class RegistroTest extends TestCase
{


    public function test_pagina_novo_cadastro_é_visivel_para_todos()
    {
        $response = $this->get(route('cadastro.novo'));
        $response->assertSuccessful();
    }

    public function test_qualquer_pessoa_pode_se_cadastrar()
    {
        Notification::fake(); 
        $email = 'teste_'.uniqid().'@email.com.br';

        $response = $this->post('/cadastro/salvar', [
            'name'      => 'teste',
            'email'     => $email,
			'password'  => '01020102',
        ]);

        $response->assertStatus(200); 

    }
    

    
    /*
    
    test_não_deve_ser_possivel_se_cadastrar_com_email_já_exstente
    */

    
}
