<?php 

namespace App\Actions;

use App\Repositories\ArquivoRepository;

class BlocosUpload
{
	public function __construct(){
		$this->arquivo 			= new ArquivoRepository;
        $this->twig             = new Twig(); 
    }
    
    public function exec($ref,$titulo,$tipo,$bloco,$componente,$texto=''){

        if($bloco == 'img'){
            
            $img = $this->arquivo->getArquivo($ref,$tipo);

            $data['urlImgMini']     = ($img) ? url('uploads/thumb-'.$img->arquivo) : false;
            $data['urlImgMax']      = ($img) ? url('uploads/max-'.$img->arquivo) : false;
            $data['arquivoUnico']   = ($img) ? $img->arquivo : false;
        }

        if($bloco == 'galeria'){
            $data['galeria'] 	= $this->arquivo->loadGaleria($ref,$tipo);
        }
		
		$data['titulo']	= $titulo;
		$data['tipo']	= $tipo;
		$data['ref']    = $ref;
		$data['texto']  = $texto;


		return view("painel.blocos.componentes.$componente", $data)->render();
		
    } 

}
