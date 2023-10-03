<?php

namespace App\Actions;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Illuminate\Support\Facades\Auth;

class Twig
{
	public function render($arquivo,$data = [],$retorno = false){


        $appRoot = dirname(dirname(dirname(__FILE__)));

        $data['anoAtual']       = date("Y");
        $data['csrf_token']     = csrf_token();
        $data['baseUrl']        = url('').'/';
        $data['uploadPasta']    = url('').'/uploads';
        $data['userData']       = (Auth::user()) ? Auth::user() : '';

		$loader = new FilesystemLoader($appRoot . '/resources/twigViews');
        $twig = new \Twig\Environment($loader, ['debug' => true]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());


        $item = $twig->render($arquivo, $data);

        

        return $item;  
        /*
        if($retorno){
            return $item;            
        }else{
            echo $item;
        }
        */
	}
}


?>