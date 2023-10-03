<?php

namespace App\Repositories;
use App\Models\Categoria; 
use App\Repositories\DataArquivo;

class DataCategoria
{

    public function __construct(){
        $this->categoria = new Categoria();
    }

    public function insert($data){

        $this->categoria->fill($data);
        $this->categoria->setSlug($data['nome']);        
        $this->categoria->save();
        
    }

    public function update($data,$id){

        $item = $this->categoria::find($id);
        $item->fill($data);
        $item->setSlug($data['nome']);        
        $item->save();

    }


    public function delete($id){
        $item       = $this->categoria::find($id);
        $item->delete();
    }

    public function load(){
        return $this->categoria::all();
    }


    public function listByTipo($tipo,$limite = false){

        $rs = $this->categoria::where('tipo', $tipo);
        if($limite){
			$rs = $rs->limit($limite);
		} 
        return $rs->get();
    }

    public function getByIdTipo($id,$tipo){
        return $this->categoria::where('tipo', $tipo)->where('id', $id)->first();
    }

    public function getById($id){
        return $this->categoria::find($id);
    }

    public function getBySlug($slug){
        return $this->categoria::where('slug', $slug)->first();
    }

    public function listItem(){
        return $this->categoria::where('tipo', 'anuncio')->where('user_id',getUserId())->get();
    }

    public function listByCategoriaId($categoriaId){
        return $this->categoria::where('categoria_id', $categoriaId)->get();
    }

    public function listByUF($uf){
        return $this->categoria::where('uf', $uf)->get();
    }
    
}