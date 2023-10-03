<?php 

namespace App\Controllers;

use App\Rules\ValidaFormAnuncio;
use App\Actions\BlocosUpload;
use App\Repositories\DataItem;
use App\Repositories\DataArquivo;
use App\Repositories\DataCategoria;
use App\Repositories\DataEstado;

class AnuncioController extends Controller
{
	public function __construct(){
		parent:: __construct(); 

        $this->validaFormAnuncio 	= new ValidaFormAnuncio;
		$this->item 				= new DataItem;
		$this->estados 				= new DataEstado;
		$this->arquivo 				= new DataArquivo;
		$this->categoria			= new DataCategoria;
		$this->blocosUpload			= new BlocosUpload;

		$this->data['formUrl'] 			= BASE_URL.'painel/anuncios';
		$this->data['tipoImgDestaque'] 	= 'destaque';
        $this->data['tipoGaleria'] 		= 'galeria';
        $this->data['tipoSlide'] 		= 'slide';
		$this->data['estados']  		= $this->estados->load();
		$this->data['categorias']  		= $this->categoria->load();
 
    }

    public function lista(){
		$this->data['lista'] 	= $this->item->listAnuncios('anuncio');
		Twig::render('painel/anuncios/lista.htm', $this->data);
    }
    
    public function novo(){
		$ref =  uniqid();
		$this->data['dataForm']['ref'] 		= $ref;
		$this->data['action'] 				= 'insert';
		$this->data['actionForm'] 			= BASE_URL.'/painel/anuncios/insert';
		$this->data['blocoGaleria']  		= $this->blocosUpload->exec($ref,'Galeria','galeria','galeria','galeria02');
		$this->data['blocoImgDestaque']  	= $this->blocosUpload->exec($ref,'Destaque','destaque','img','imagem02');
		Twig::render('painel/anuncios/formulario.htm', $this->data );
    }
 
    public function insert(){
		$dataForm = $this->request;
		$dataForm['tipo'] =  'anuncio';

		$this->validaFormAnuncio->validaForm($dataForm);
		$this->item->insert($dataForm);

		mensagem('sucesso',BASE_URL.'/painel/anuncios/');
    }
    
    public function show($id){

		$item = $this->item->getByIdTipo($id,'anuncio');

		
		$this->data['actionForm'] 			= BASE_URL.'/painel/anuncios/update';		
		$this->data['dataForm'] 			= $item;
		$this->data['blocoGaleria']  		= $this->blocosUpload->exec($item['ref'],'Galeria','galeria','galeria','galeria02');
		$this->data['blocoImgDestaque']  	= $this->blocosUpload->exec($item['ref'],'Destaque','destaque','img','imagem02');

        Twig::render('painel/anuncios/formulario.htm', $this->data);
    } 
    
    public function update(){
		$data = $this->request;
		$this->validaFormAnuncio->validaForm($data);
		$this->item->update($data,$this->request['id']);
		mensagem('sucesso',BASE_URL.'/painel/anuncios/');
    }
    
    public function destroy($id){

		$this->item->destroy($id);
		mensagem('deletado');
		
    }
	
}
