<?php 

namespace App\Controllers;

use App\Models\Item;
use App\Models\MetaData;
use App\Models\Arquivo;
use App\Models\Categoria;
use App\Models\Estado;
use App\Rules\ValidaFieldTexto;
use App\Rules\ValidaFormItem;
use App\Actions\GerarPDF;


class ProjetoController extends Controller
{

	public function __construct(){
		parent:: __construct(); 

        $this->validaFormItem 	= new ValidaFieldTexto;
        $this->categoria		= new Categoria;
		$this->item 			= new Item();
		$this->metaData 		= new MetaData();
		$this->arquivo 			= new Arquivo();
        $this->estados 			= new Estado;
		$this->GerarPDF			= new GerarPDF();
		$this->formUrl			= BASE_URL.'/painel/missoes';
     
    }

    public function lista(){
		$data['lista'] = $this->item->listByTipo('projeto');
		$data['formUrl'] 	= $this->formUrl;
		Twig::render('painel/projetos/lista.htm', $data);
    }
     
    
    public function novo(){
		$data['dataForm']['ref'] 	= uniqid();
		$data['action'] 			= 'insert';
		$data['actionForm'] 		= BASE_URL.'/painel/missoes/insert';
		$data['tipoImgDestaque'] 	= 'destaque';
        $data['tipoGaleria'] 		= 'galeria';
		$data['estados']  			= $this->estados->load();
		Twig::render('painel/projetos/formulario.htm', $data );
    }
    
 
    public function insert(){
		$dataForm = $this->request;
		$dataForm['tipo'] =  'projeto';

		$this->validaFormItem->validaForm($dataForm);
		$this->item->insert($dataForm);

		mensagem('sucesso',BASE_URL.'painel/missoes/');
    }
     
    
    public function show($id){

		$item = $this->item->getByIdTipo($id,'projeto');

		$data['actionForm'] 	= BASE_URL.'painel/missoes/update';		
		$data['dataForm'] 		= $item;
		$data['categorias']  	= $this->categoria->load();
		$data['imgDestaque']  	= $this->arquivo->getArquivo($item['ref'],'destaque');
		$data['galeria'] 		= $this->arquivo->loadGaleria($item['ref'],'galeria');
        $data['estados']  			= $this->estados->load();

        Twig::render('painel/projetos/formulario.htm', $data);
    } 
    
    public function update(){
		$data = $this->request;
		$this->validaFormItem->validaForm($data);
		$this->item->update($data,$this->request['id']);
		mensagem('sucesso','reload');
    }
    
    public function destroy($id){

		$this->item->destroy($id);
		$msg['status'] = 0;
		$msg['texto'] = 'Item excluído com sucesso';
		mensagem('deletado',BASE_URL.'/painel/projetos/');
    }

	


	
}
