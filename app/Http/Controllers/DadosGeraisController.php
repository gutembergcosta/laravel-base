<?php 

namespace App\Controllers;

use App\Rules\ValidaFormAnuncio;
use App\Actions\BlocosUpload;
use App\Repositories\DataItem;
use App\Repositories\DataDadosGerais;
use App\Repositories\DataArquivo;
use App\Repositories\DataCategoria;
use App\Repositories\DataEstado;

class DadosGeraisController extends Controller
{
	public function __construct(){
		parent:: __construct(); 

        $this->validaFormAnuncio 	= new ValidaFormAnuncio;
		$this->dadosGerais 			= new DataDadosGerais;
		$this->estados 				= new DataEstado;
		$this->arquivo 				= new DataArquivo;
		$this->categoria			= new DataCategoria;
		$this->blocosUpload			= new BlocosUpload;

		$this->data['formUrl'] 			= BASE_URL.'painel/item';
		$this->data['tipoImgDestaque'] 	= 'destaque';
        $this->data['tipoGaleria'] 		= 'galeria';
        $this->data['tipoSlide'] 		= 'slide';
		$this->data['estados']  		= $this->estados->load();
		$this->data['categorias']  		= $this->categoria->load();
 
    }

   
    
    public function show(){

		$item = $this->dadosGerais->get();

		
		$this->data['actionForm'] 			= BASE_URL.'/painel/dados-gerais/update';		
		$this->data['dataForm'] 			= $item;
		$this->data['blocoGaleria']  		= $this->blocosUpload->exec($item['ref'],'Galeria','galeria','galeria','galeria02');
		$this->data['blocoImgDestaque']  	= $this->blocosUpload->exec($item['ref'],'Destaque','destaque','img','imagem02');

        Twig::render('painel/dados-gerais/formulario.htm', $this->data);
    } 
    
    public function update(){
		$data = $this->request;
		$this->validaFormAnuncio->validaForm($data);
		$this->dadosGerais->update($data,$this->request['id']);
		mensagem('sucesso',BASE_URL.'/painel/item/');
    }
    
    public function destroy($id){

		$this->dadosGerais->destroy($id);
		mensagem('deletado');
		
    }
	
}
