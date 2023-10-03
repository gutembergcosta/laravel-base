<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AcessosTest extends TestCase
{

    public function test_pagina_login_é_visivel_para_todos()
    {

        $response = $this->get('/login');

        $response->assertSuccessful();
        //$response->assertSuccessful();
        //$response->assertViewIs('auth.login');
    }
    
    public function test_admin_cadastrados_podem_logar()
    {
        $user = User::find(1);
        $this->post('/entrar', [
            'email' => 'admin@admin.com.br',
            'password' => 'olaria01',
        ]);
        $this->assertAuthenticatedAs($user);

    }
    public function test_usuarios_cadastrados_podem_logar()
    {
        $user = User::find(1);
        $this->post('/entrar', [
            'email' => 'admin@admin.com.br',
            'password' => 'olaria01',
        ]);
        $this->assertAuthenticatedAs($user);

    }

    public function test_usuarios_não_logados_devem_redirecionados_para_pagina_login()
    {
        $response = $this->get('/painel/item');
        $response->assertRedirect('/login');
    }
    
    public function test_usuarios_logados_podem_acessar_o_painel()
    {
        $user = User::where('status','autorizado')->first();
        $response = $this->actingAs($user);
        $response = $this->get('/painel/item');
        $response->assertSuccessful();
    }

    



    /*
    novos usuarios precisam de um id de usuario para se cadastrar
    somente usuarios tipo admin podem acessar páginas especificas
    
    */

    
}
