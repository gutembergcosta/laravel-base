<?php

namespace App\Actions;

use App\Repositories\DataEstado;

use App\Repositories\DataItem;



class ListCategoriasUF
{

    public function list(){

		$this->item 			= new DataItem;
		$this->estado 			= new DataEstado;

        $matriz  = $this->estado->load();

        $rs = [];
    
        foreach($matriz as $key => $value) {
            $qte = count($this->item->listByUF($key));
            
            if($qte> 0){
                $item['nome']   = $value;
                $item['qte']    = $qte;

                $rs[] = $item;
            }
        }

        return $rs;

        

    }
}



