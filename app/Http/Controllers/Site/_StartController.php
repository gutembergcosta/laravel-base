<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StartController extends Controller
{

    public function __construct() {
        dd('aki');
      }

    public function start()
	{
		dd('aki');
	}

    public function entrar(LoginRequest $request){

        if (auth()->attempt([
            'email'     => $request->email, 
            'password'  => $request->password
        ])) {
            $data['destino']  = route('painel.home');
        } else {
            $data['msg']    = 'Usuário ou senha inválidos!';
        }

        return response()->json($data,200);

    }

    public function logout(){

        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
