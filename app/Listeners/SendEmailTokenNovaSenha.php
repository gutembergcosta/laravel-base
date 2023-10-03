<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Actions\UserCreated;
use Illuminate\Http\Request;
use App\Mail\EnviaEmail;

class SendEmailTokenNovaSenha
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $data = $event->data;

        
        \Mail::to($data['email'])->send(new EnviaEmail($data,'nova-senha','Nova senha'));
        
        
    }
}
