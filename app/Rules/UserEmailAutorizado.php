<?php


namespace App\Rules;
use App\Models\User;

use Illuminate\Contracts\Validation\Rule;

class UserEmailAutorizado implements Rule
{

    public function __construct()
    {
        $this->mensagem = 'Email não encontrado';
    }

    public function passes($attribute, $value)
    {
        $user = User::where('email', $value)->where('status','autorizado')->first();
        return ($user) ?  true : false;
    }


    public function message()
    {
        return $this->mensagem;
    }
}
