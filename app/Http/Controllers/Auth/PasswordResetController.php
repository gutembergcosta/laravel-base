<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordReset\SolicitarNovaSenhaRequest;
use App\Http\Requests\PasswordReset\ValidaTokenRequest;
use App\Services\PasswordResetService;
use App\Services\UserService;



class PasswordResetController extends Controller
{

    public function __construct(){
		parent:: __construct(); 
		$this->service	= new PasswordResetService;
    }

    public function solicitar(){
        $data['formUrl'] = route('nova-senha.enviar-token');
        return view('painel.nova-senha', compact('data') );
    }

    public function enviar(SolicitarNovaSenhaRequest $request){
        $data = $this->service->enviar($request);
        return response()->json($data,200);
    } 

    public function redefinir($token){

        $data['formUrl'] = route('nova-senha.salvar');
        $data['token'] = $token;

        return view('painel.redefinir',$data);
        
    }   
    
    public function salvar(ValidaTokenRequest $request, UserService $userService){
        $data = $this->service->salvarNovaSenha($request);
        return response()->json($data,200);
    }   
}
