<?php

namespace App\Actions;
use App\Repositories\DataUsuario;

class Logar
{

    public function __construct(){
        $this->usuario = new DataUsuario();
    }

    public function execute($tipo, $data = ''){

        switch ($tipo) {
            case "login":   $this->login($data); break;
            case "logout":  $this->logout(); break;
        }

    }

    private function login($data){
        $user = $this->usuario->verificaUser($data['email'],$data['senha']);

        if($user){
            $_SESSION["user"] = $user;
            $redirect['destino'] = BASE_URL.'/painel/item/';
            echo json_encode($redirect);
        }else{
            $msg['texto'] = 'Dados do usuário inválido';
            mensagem($msg);
        }
    }

    private function logout(){
        unset($_SESSION['user']);
        header("Location: ".BASE_URL); 
    }


}



