<?php

namespace App\Repositories;
use App\Models\Categoria; 

class CategoriaRepository
{

    public function __construct(){
        $this->tabela = new Categoria();
    }

    public function insert($data){
        
		$this->tabela->create($data->all());

    }

    public function update($data,$id){
        $item = $this->tabela->find($id);
        $item->setSlug($data['nome']);
        $item->update($data);
    }


    public function destroy($id){
        $item   = $this->tabela->find($id);
        $item->delete();
    }

    public function getById($id){
        return $this->tabela->find($id);
    }

    public function list(){
        return $this->tabela->all();
    }
    
}