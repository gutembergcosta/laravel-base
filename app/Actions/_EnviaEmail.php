<?php

namespace App\Actions;

use App\Libraries\Twig;
use Mail;

class EnviaEmail
{

    private $titulo = [
        'default' => 'Email do Site',
        'novo-inscrito' => 'Novo cadastro',
    ];

    public function exec($tipo,$data, $titulo = 'default'){
        
        $data = [
            'title' => 'Mail from teste.com',
            'body'  => 'This is for testing email using smtp'
        ];
       
        
       
    }
    
    

}



