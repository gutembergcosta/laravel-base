<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PainelController extends Controller
{

    public function __construct()
    {
		parent::__construct();
    }
    

	public function login()
	{
		Twig::render('painel/login.htm');
	}

	public function home()
	{
		$data = [];
		return view('painel.home', compact('data') );
	}
	public function homeFull()
	{
		$data = [];
		return view('painel.home-full', compact('data') );
	}


	

	public function formFull()
	{
        $tituloFormulario = 'Formulário';

		Twig::render('painel/form-full.htm',compact('tituloFormulario'));
	}

	public function formBasico()
	{
        $tituloFormulario = 'Formulário';

		Twig::render('painel/form-basico.htm',compact('tituloFormulario'));


	}

	public function lista()
	{
		Twig::render('painel/lista.htm', compact('item','actionForm'));


	}

	

	public function testeValidacao(){

		$email = 'example@email.com';
		$username = 'admin';
		$password = 'test';
		$age = 29;
		
	
		$this->validate->name('email')->value($email)->pattern('email')->required();
		$this->validate->name('username')->value($username)->pattern('alpha')->required();
		$this->validate->name('password')->value($password)->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required();
		$this->validate->name('age')->value($age)->min(18)->max(40);
		
		if($this->validate->isSuccess()){
			echo "Validation ok!";
		}else{
			echo "Validation error!";
			var_dump($this->validate->getErrors());
			echo $this->validate->displayErrors();
    	}


	}
    
}
