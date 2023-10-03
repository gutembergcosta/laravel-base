<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\BlocosUpload;
use App\Repositories\CategoriaRepository;
use Mpdf\Mpdf;
use Carbon\Carbon;


class CategoriaController extends Controller
{
	public function __construct(){
		parent:: __construct(); 

		$this->categoria	= new CategoriaRepository;

    }

    public function lista(){
		
		$data['lista']  	= $this->categoria->list(); 
		$data['formUrl']  	= url('painel/categorias/');

		Twig::render('painel/categorias/lista.htm', $data);
    }
    
    public function novo(){
		$ref =  uniqid();
		$data['dataForm']['ref'] 	= $ref;
		
		$data['action'] 			= 'insert';
		$data['actionForm'] 		= url('/painel/categorias/insert');
		Twig::render('painel/categorias/formulario.htm', $data );
    }
 
    public function insert(Request $request){

		$request['tipo'] = 'anuncio';
		$request['slug'] = slug($request->nome);


		$this->categoria->insert($request);
		mensagem('sucesso',url('/painel/categorias/'));
    }
    
    public function show($id){

		$item = $this->categoria->getById($id);

		
		$this->data['actionForm'] 			= url('/painel/categorias/update');		
		$this->data['dataForm'] 			= $item;

        Twig::render('painel/categorias/formulario.htm', $this->data);
    } 
    
    public function update(Request $request){

		$request->validate([
            'nome' => 'required|max:255',
        ]);

		$this->categoria->update($request,$request->id);
		mensagem('sucesso',url('/painel/categorias/'));
		
    }
    
    public function destroy($id){
		$this->categoria->destroy($id);
		mensagem('deletado');
    }
	
}
