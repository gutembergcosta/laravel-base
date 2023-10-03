<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\BlocosUpload;
use App\Services\UserService;
use Mpdf\Mpdf;
use Carbon\Carbon;


class UsuarioController extends Controller
{
	public function __construct(UserService $userService){
		parent:: __construct(); 

		$this->userService		= $userService;
		$this->blocosUpload		= new BlocosUpload;

    }

    public function lista(){
		
		$data = $this->userService->list('user'); 

		Twig::render('painel/usuarios/lista.htm', $data);
    }
    
    public function novo(){
		$ref =  uniqid();
		$data['dataForm']['ref'] 	= $ref;
		
		$data['action'] 			= 'insert';
		$data['actionForm'] 		= url('/painel/usuarios/insert');
		$data['blocoGaleria']  		= $this->blocosUpload->exec($ref,'Galeria','galeria','galeria','galeria02');
		$data['blocoImgDestaque']  	= $this->blocosUpload->exec($ref,'Destaque','destaque','img','imagem02');
		Twig::render('painel/usuarios/formulario.htm', $data );
    }

    public function megaForm(){
		$ref =  uniqid();
		$data['dataForm']['ref'] 	= $ref;
		$data['action'] 			= 'insert';
		$data['actionForm'] 		= url('/painel/usuarios/insert');
		$data['blocoGaleria']  		= $this->blocosUpload->exec($ref,'Galeria','galeria','galeria','galeria02');
		$data['blocoImgDestaque']  	= $this->blocosUpload->exec($ref,'Destaque','destaque','img','imagem02');
		Twig::render('painel/usuarios/megaform.htm', $data );
    }
    public function testePdf(Mpdf $mpdf){

		//$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML('<h1>Hello world!</h1>');
		$mpdf->Output();
    }
    public function testeCarbon(){

		$mytime = Carbon::now();
		echo $mytime->toDateTimeString();
    }
 
    public function insert(Request $request){

		$request['tipo'] = 'anuncio';
		$request['slug'] = slug($request->nome);


		$this->userService->insert($request);
		mensagem('sucesso',url('/painel/usuarios/'));
    }
    
    public function show($id){
		
        $item = $this->userService->getById($id);
		
		$this->data['actionForm'] 			= url('/painel/usuarios/update');		
		$this->data['dataForm'] 			= $item;
		$this->data['blocoGaleria']  		= $this->blocosUpload->exec($item['ref'],'Galeria','galeria','galeria','galeria02');
		$this->data['blocoImgDestaque']  	= $this->blocosUpload->exec($item['ref'],'Destaque','destaque','img','imagem02');

        Twig::render('painel/usuarios/formulario.htm', $this->data);
    } 
    
    public function update(Request $request){

        

		$request->validate([
            'nome' => 'required|max:255',
        ]);

		$this->userService->update($request,$request->id);
		mensagem('sucesso',url('/painel/usuarios/'));
		
    }
    
    public function destroy($id){
		$this->userService->destroy($id);
		mensagem('deletado');
    }
	
}
