<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Arquivo;
use App\Models\Pessoa;
use DbHelper;


class UserObserver
{

    public function created(User $user)
    {
        DbHelper::addLog('insert','user',$user->id );
    }


    public function updated(User $user)
    {
        $action = 'update';
        
        DbHelper::addLog($action,'user',$user->id );
    }


    public function deleted(User $user)
    {
        DbHelper::addLog('delete','user',$user->id );
    }

    public function deleting(User $user)
    {
        Pessoa::destroy($user->id);
    }


    public function restored(User $user)
    {
        //
    }


    public function forceDeleted(User $user)
    {
        $arquivos = Arquivo::where('ref', $user->ref)->get();

        if ($arquivos) {
            foreach ($arquivos as $arquivo) {
                Arquivo::destroy($arquivo->id);
            }
        }
    }
}
