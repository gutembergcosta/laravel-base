<?php 

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Carbon\Carbon;
use Mail;
use App\Mail\EnviaEmail;
use App\Actions\BlocosUpload;




class TestesController extends Controller
{

    public function __construct(
		BlocosUpload $blocosUpload
	){
		parent:: __construct(); 

		$this->blocosUpload	= $blocosUpload;

    }
	

	public function testeMpdf(Mpdf $mpdf){
		$mpdf->WriteHTML('<h1>Hello world!</h1>');
		$mpdf->Output();
    }    

    public function testeCarbon(){
		$mytime = Carbon::now();
		echo $mytime->toDateTimeString();
    }

	public function megaForm(){
		$ref =  uniqid();
		$data['dataForm']['ref'] 	= $ref;
		$data['action'] 			= 'insert';
		$data['actionForm'] 		= url('painel.iteminsert');
		$data['blocoGaleria']  		= $this->blocosUpload->exec($ref,'Galeria','galeria','galeria','galeria02');
		$data['blocoImgDestaque']  	= $this->blocosUpload->exec($ref,'Destaque','destaque','img','imagem02');
		$data['urlModal']  			= route('teste.modal');
   		
		

		return view('painel.item.megaform', $data );
    }


	public function modal(){
		$ref =  uniqid();
		$data['dataForm']['ref'] 	= $ref;
		$data['action'] 			= 'insert';
		$data['actionForm'] 		= url('painel.iteminsert');
		$data['blocoGaleria']  		= $this->blocosUpload->exec($ref,'Galeria','galeria','galeria','galeria02');
		$data['blocoImgDestaque']  	= $this->blocosUpload->exec($ref,'Destaque','destaque','img','imagem02');
		$data['urlModal']  			= route('teste.modal');

		
		$html = Twig::render('painel/item/modal.htm', $data);
        return response($html)->header('Content-Type', 'text/html');

	}
	
}
