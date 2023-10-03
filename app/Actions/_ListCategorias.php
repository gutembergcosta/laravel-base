<?php

namespace App\Actions;

use App\Repositories\DataCategoria;
use App\Repositories\DataItem;


class ListCategoriasx
{

    public function list(){

		$this->item 			= new DataItem;
		$this->categoria		= new DataCategoria;

        $matriz  = $this->categoria->load();

        $rs = [];
    
        foreach($matriz as $item) {
            $item['qte']    = count($this->item->listByCategoriaId($item['id']));
            
            $rs[] = $item;
        }

        return $rs;

        

    }
}



