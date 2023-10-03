<?php


namespace App\Rules;
use App\Models\User;

use Illuminate\Contracts\Validation\Rule;

class EmailCadastrado implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {


        if(request()->method() == 'POST'){
            return (User::where('email', $value)->exists() ) ? false : true;
        }

        if(request()->method() == 'PUT'){
            return $this->emailExistToAnotherUser($value);
        }
    }

    private function emailExistToAnotherUser($email){

        $userId = (isAdmin()) ? request()->id : auth()->user()->id;

        $userEmailAtual = User::find($userId)->email;
        if($userEmailAtual == $email){ 
            return true; 
        }

        $userEmail = User::where('id','!=',$userId)->where('email',$email)->exists();

        return ($userEmail) ? false : true;
    
    }


    public function message()
    {
        return 'Este email já está cadastrado';
    }
}
