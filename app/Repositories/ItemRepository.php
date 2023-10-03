<?php

namespace App\Repositories;
use App\Models\Item; 

class ItemRepository
{


    public function __construct(Item $item){
        $this->tabela = $item;
    }

    public function insert($data){
		$this->tabela->create($data);
    }

    public function update($data,$id){
        $item = $this->tabela->find($id);
        $item->update($data);
    }

    public function destroy($id){
        $this->tabela->destroy($id);
    }

    public function list($data = null){

        $tipo = (isset($data['tipo'])) ?: false;
        $limite = (isset($data['limite'])) ?: false;

        $rs = $this->tabela;

        $rs->when($tipo, function($rs,$tipo) {
            $rs->where('tipo', $tipo);
        });

        $rs->when($limite, function($rs,$limite) {
            $rs->limit($limite);
        });
        return $rs->latest()->get();
        
    }

    private $tabelaLinha = [
        0 => 'nome',
        1 => 'nome',
    ];

    public function ajaxList($formData){
        $rs = $this->tabela->where('tipo', 'anuncio');

		$draw 				= $formData['draw'];
		$row 				= $formData['start'];
		$rowperpage 		= $formData['length']; // Rows display per page
        $columnIndex 		= $formData['order'][0]['column']; // Column index
		$columnName 		= $formData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder 	= $formData['order'][0]['dir']; // asc or desc
		$searchValue 		= $formData['search']['value']; // Search value

        $ordenar    = $formData['columns'][$columnIndex]['orderable'];
        $ordem      = $formData['columns'][0]['orderable'];
        $this->direcao    = $formData['order'][0]['dir'];
        $this->dbColuna   = $this->tabelaLinha[$columnIndex];
        
        $rs->when($searchValue, function($rs,$searchValue) {
            $rs->where('nome','LIKE',"%{$searchValue}%");
        });

        $rs->when(($ordenar != ''), function($rs ) {
            $rs->orderBy($this->dbColuna, $this->direcao);
        });

        return $rs->limit(10)->get();
    }

    public function qte(){
        $data = $this->list();
        return count($data);
    }

    public function getByIdTipo($id,$tipo){
        return $this->tabela->where('tipo', $tipo)->where('id', $id)->first();
    }

    public function getById($id){
        return $this->tabela->find($id);
    }

    public function getBySlug($slug){
        return $this->tabela->where('slug', $slug)->first();
    }

    public function listItem(){
        return $this->tabela->where('tipo', 'anuncio')->where('user_id',getUserId())->get();
    }

    public function listByCategoriaId($categoriaId){
        return $this->tabela->where('categoria_id', $categoriaId)->get();
    }

    public function listByUF($uf){
        return $this->tabela->where('uf', $uf)->get();
    }
    
}