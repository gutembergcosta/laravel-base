<?php

namespace App\Rules;
use App\Cadastro;
use App\User;

use Illuminate\Contracts\Validation\Rule;

class VerificaEmail implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return (User::where('email', $value)->first() ) ? true : false;
    }


    public function message()
    {
        return 'Este email não foi encontrado';
    }
}
