<?php


namespace App\Rules;
use App\Models\User;

use Illuminate\Contracts\Validation\Rule;

class UserPodeAlterarSenha implements Rule
{

    public function __construct()
    {
        $this->mensagem = 'Erro ao atualizar senha';
    }

    public function passes($attribute, $value)
    {
        $userData = auth()->user();

        if($userData->tipo == 'admin') return true;

        return ($userData->id == $value) ?  true : false;

    }


    public function message()
    {
        return $this->mensagem;
    }
}
