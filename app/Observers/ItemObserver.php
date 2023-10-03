<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Arquivo;
use DbHelper;


class ItemObserver
{

    public function created(Item $item)
    {
        DbHelper::addLog('insert','item',$item->id );
    }


    public function updated(Item $item)
    {
        DbHelper::addLog('update','item',$item->id );
    }


    public function deleted(Item $item)
    {
        DbHelper::addLog('delete','item',$item->id, $item->nome );
    }

    public function deleting(Item $item)
    {


        $arquivos = Arquivo::where('ref', $item->ref)->get();

        if ($arquivos) {
            foreach ($arquivos as $arquivo) {
                Arquivo::destroy($arquivo->id);
            }
        }
    }


    public function restored(Item $item)
    {
        //
    }


    public function forceDeleted(Item $item)
    {
        //
    }
}
