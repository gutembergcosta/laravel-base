<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CadastroRequest;
use App\Services\UserService;




class RegistroController extends Controller
{

    public function __construct(
		UserService $userService
	){
		parent:: __construct(); 
		$this->userService	= $userService;
    }

    public function novo(){
        $data['formUrl'] = route('cadastro.salvar');
        $data['solicitarNovaSenha'] = route('nova-senha.solicitar');

        return view('painel.cadastro',$data);
        }

    public function salvar(CadastroRequest $request){
        $data = $this->userService->insertBySite($request);
        return response()->json($data,200);
    } 

    public function validar($userToken){
        $data = $this->userService->validar($userToken);

        echo "<script>
            alert('{$data['msg']}');
            location.replace('{$data['destino']}');
        </script>";
    }   
}
