<?php

namespace App\Actions;

class VerificaSecurityToken
{

    public function execute(){

        $token = isset($_POST['csrf-token']) ? $_POST['csrf-token'] : false; 

        if (!$token || $token !== $_SESSION['csrf-token']) {
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        } 
    }
}



