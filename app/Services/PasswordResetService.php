<?php 

namespace App\Services;


use Illuminate\Support\Facades\DB;
use App\Events\RequisitaNovaSenha;
use Carbon\Carbon;

class PasswordResetService 
{

	public function enviar($data){

		$token = mdx($data->email.'|'.Carbon::now()->addHours(4).'|'.rand(1,99));

		$user = DB::table('users')->where('email', $data->email)->first();

		$dataEmail = [
			'email' => $user->email,
			'nome' => $user->name,
			'token' => $token,
		];

		RequisitaNovaSenha::dispatch($dataEmail);

		return [
			'msg'=> 'Solicitação de senha enviada com sucesso, verifique seu email!',
			'tipo'=> 'alert',
			'destino' => url(''),
		];

	}

	public function salvarNovaSenha($request){

		$token = mdx($request->token,'d');
        $matriz = explode('|',$token);
        $email = $matriz[0];
		$data['password']= bcrypt($request->password);

		DB::table('users')->where('email',$email)->update($data);

		return [
			'msg'=> 'Nova senha cadastrada com sucesso!',
			'tipo'=> 'alert',
			'destino' => url(''),
		];
	}

	
}
