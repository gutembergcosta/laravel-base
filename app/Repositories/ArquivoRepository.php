<?php

namespace App\Repositories;
use App\Models\Arquivo; 



class ArquivoRepository
{

    public function __construct(){
        $this->arquivo = new Arquivo();
    }

    public function getArquivo($ref,$tipo){
        return $this->arquivo::where('ref', $ref)->where('tipo', $tipo)->get()->last();
    }

    public function loadGaleria($ref,$tipo){
        return $this->arquivo::where('ref', $ref)->where('tipo', $tipo)->get();
    }

    public function getByRef($ref){
        
        return $this->arquivo::where('ref', $ref)->get();
    }

    public function insert($data){
        Arquivo::create($data->all());
    }

    public function destroy($ref){

		$arquivos 	= $this->arquivo->getByRef($ref);

		if($arquivos){
			foreach($arquivos as $item){
				$this->arquivo->excluirArquivo($item['arquivo']);
			}
		}

    }

    public function excluirArquivo($arquivo){

        $prefixos = ['thumb','max','original','mini','slide'];

        foreach($prefixos as $prefixo){
            $filename = "uploads/".$prefixo.'-'.$arquivo;
			          
            //ddlog('filename: '.$filename);
            if (file_exists($filename)) {
				unlink($filename);
                //ddlog('deve ter excluído: '.$filename);
            } 
        }

        

        $this->arquivo::where('arquivo', $arquivo)->delete();

    }
   
}