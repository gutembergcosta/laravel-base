<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Actions\UserCreated;
use Illuminate\Http\Request;
use App\Mail\EnviaEmail;

class SendEmailNovoCadastro
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $user = $event->user;

        
        \Mail::to($user->email)->send(new EnviaEmail($user,'novo-cadastro','Confirme seu cadastro'));
        
        
    }
}
