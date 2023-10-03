<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Item;

class UserTest extends TestCase
{

    
    // ================= PRÓXIMOS =================
    /*

        - Usuários logados não podem acessar as rotas: 
            - login
            - cadastro.validar
            - nova-senha.solicitar
            - nova-senha.redefinir
        - test_usuario_autorizado_pode_atualizar_item
        - test_usuario_autorizado_pode_deletar_item

    */

    public function test_acesso_a_pagina_user_lista()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->first();
        $response = $this->actingAs($user)->get(route('usuario.lista'));
        $response->assertSuccessful();
    }

    public function test_acesso_a_pagina_user_novo()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $response = $this->actingAs($user)->get(route('usuario.lista'));
        $response->assertSuccessful();
    }

    public function test_acesso_a_pagina_user_edit()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $response = $this->actingAs($user)->get(route('usuario.lista'));
        $response->assertSuccessful();
    }

    public function test_acesso_a_pagina_user_por_usuario_bloqueado_redireciona_para_pagina_login()
    {
        $user = User::where('tipo','user')->where('status','!=','autorizado')->get()->first();
        $this->actingAs($user)->get(route('usuario.lista'))->assertRedirect(route('login'));
    }


    public function test_admin_pode_inserir_novo_usuario()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->get()->first();

        $email = 'teste_'.uniqid().'@email.com.br';

        $matriz = [
            'name'      => 'teste',
            'status'    => 'teste',
            'email'     => $email,
			'password'  => '01020102',
        ];
        $response = $this->actingAs($user)->post(route('usuario.insert'), $matriz);
        $response->assertStatus(200); 

    }

    public function test_usuario_autorizado_pode_excluir()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $deletar_id = User::where('tipo','user')->where('status','pendente')->latest()->first()->id;
        $response = $this->actingAs($user)->delete(route('usuario.delete',$deletar_id));
        $response->assertStatus(200); 

    }


    public function test_acesso_a_pagina_perfil_by_user()
    {
        $user = User::where('tipo','user')->where('status','autorizado')->get()->first();
        $response = $this->actingAs($user)->get(route('painel.perfil'));
        $response->assertSuccessful();
    }


    public function test_acesso_a_pagina_perfil_by_admin()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $response = $this->actingAs($user)->get(route('painel.perfil'));
        $response->assertSuccessful();
    }

    public function test_update_perfil_by_admin()
    {
        $user = User::where('status','autorizado')->where('tipo','user')->first();

        $matriz = [
            'id'        => $user->id,
            'name'      => $user->name,
            'email'     => $user->email,
            'status'    => $user->status,
        ];

        $response = $this->actingAs($user)->put(route('usuario.update'), $matriz);
        $response->assertStatus(200); 
    }


    public function test_update_perfil_by_user()
    {
        $user = User::where('status','autorizado')->where('tipo','user')->get()->first();

        $matriz = [
            'id'        => $user->id,
            'name'      => $user->name,
            'email'     => $user->email,
            'status'    => $user->status,
        ];

        $response = $this->actingAs($user)->put(route('usuario.update'), $matriz);
        $response->assertStatus(200); 
    }

    

    
}
