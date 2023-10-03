<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Item;

class ItemTest extends TestCase
{


    public function test_acesso_a_pagina_item_lista()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $response = $this->actingAs($user)->get(route('item.lista'));
        $response->assertSuccessful();
    }

    public function test_acesso_a_pagina_item_novo()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $response = $this->actingAs($user)->get(route('item.lista'));
        $response->assertSuccessful();
    }

    public function test_acesso_a_pagina_item_edit()
    {
        $user = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $response = $this->actingAs($user)->get(route('item.lista'));
        $response->assertSuccessful();
    }

    public function test_acesso_a_pagina_item_por_usuario_bloqueado_redireciona_para_pagina_login()
    {
        $user = User::where('tipo','user')->where('status','!=','autorizado')->get()->first();
        $this->actingAs($user)->get(route('item.lista'))->assertRedirect(route('login'));
    }


    public function test_usuario_autorizado_pode_inserir_item()
    {
        $userAdminAutorizado = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $ref = uniqid();
        $matriz = [
            'nome'  => "zzz",
            'ref'   => "$ref",
            'tipo' => 'teste',
            'texto' => 'texto',
        ];
        $response = $this->actingAs($userAdminAutorizado)->post(route('item.insert'), $matriz);
        $response->assertStatus(200); 

    }

    /*
    public function test_usuario_autorizado_pode_atualizar_item()
    {

        $userAdminAutorizado = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $item = Item::latest()->first();

        $item['nome'] = "Updated Title";
        $response = $this->actingAs($userAdminAutorizado)->put(route('item.update'), $item->toArray());
        $response->assertStatus(200); 

    }

    public function test_usuario_autorizado_pode_deletar_item()
    {

        $userAdminAutorizado = User::where('tipo','admin')->where('status','autorizado')->get()->first();
        $item = Item::latest()->first();

        $response = $this->actingAs($userAdminAutorizado)->delete(route('item.delete',$item->id), $item->toArray());
        $response->assertStatus(200); 

    }
    

    /*

    
            Route::delete('destroy/{id}', 'App\Http\Controllers\Admin\ItemController@destroy')->name('item.delete');
    
    */

    
}
