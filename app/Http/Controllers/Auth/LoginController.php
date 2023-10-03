<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{

    public function login()
	{

        return view('painel.login');
	}

    public function entrar(LoginRequest $request){

        if (auth()->attempt([
            'email'         => $request->email, 
            'password'      => $request->password,
            'deleted_at'    => NULL,
            'status'        => 'autorizado'
        ])) {
            $status = 200;
            $data['destino']  = route('painel.home');
        } else {
            $status = 422;
            $data['msg']    = 'Usuário ou senha inválidos!';
            $data['tipo']   = 'alert';
        }

        return response()->json($data,$status);

    }

    public function logout(){

        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
