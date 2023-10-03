<?php

namespace App\Rules;
use App\Cadastro;
use App\Arquivo;
use Illuminate\Http\Request;

use Illuminate\Contracts\Validation\Rule;

class ValidaGaleriaAnuncio implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)    
    {

        $qte = Arquivo::where('tipo', 'galeria')->where('tkn', $value)->count();

        return ($qte < 4 ) ? false : true;
    }


    public function message()
    {
        return 'É necessário no mínimo 4 imagens para finalizar o cadastro';
    }
}
