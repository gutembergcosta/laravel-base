<?php


namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;

class ValidaTokenRequestSenha implements Rule
{

    public function __construct()
    {
        $this->mensagem = 'Não é possivel realizar esta solicitação';
    }

    public function passes($attribute, $value)
    {

        $token = mdx($value,'d');
        $matriz = explode('|',$token);
        $email = $matriz[0];
        $dataLimite = $matriz[1];
        $numero = $matriz[2];
        $start  = Carbon::now();
        $end    = new Carbon($dataLimite);
        $segundos = $start->diffInSeconds($end, false);

        $status = User::where('email', $email)->first()->first()->status;

        if(
            $status == 'autorizado' &&
            $numero < 100 &&
            $segundos > 1
        ){
            return true;
        }
    }


    public function message()
    {
        return $this->mensagem;
    }
}
