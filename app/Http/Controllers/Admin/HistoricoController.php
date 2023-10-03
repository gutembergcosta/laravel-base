<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Actions\BlocosUpload;
use App\Services\HistoricoService;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;

use DbHelper;

class HistoricoController extends Controller
{
	public function __construct(
		BlocosUpload $blocosUpload,
		HistoricoService $historicoService
	){
		parent:: __construct(); 

		$this->blocosUpload	= $blocosUpload;
		$this->historicoService	= $historicoService;

    }

    public function lista(){
		$data = $this->historicoService->list('anuncio');
		$html = Twig::render('painel/historico/lista.htm', $data);
        return response($html)->header('Content-Type', 'text/html');
		
    }
    public function ajaxList(Request $request){
		return $this->historicoService->ajaxList($request);
    }
    
    public function novo(){
		$data = $this->historicoService->novo();
		$html = Twig::render('painel/historico/formulario.htm', $data);
        return response($html)->header('Content-Type', 'text/html');
    }
 
    public function insert(ItemRequest $request){
		$data = $this->historicoService->insert($request);
		return response()->json($data,200);
    }
    
    public function show($id){
		$data = $this->historicoService->show($id);
		$html = Twig::render('painel/historico/formulario.htm', $data);
        return response($html)->header('Content-Type', 'text/html');
    } 
    
    public function update(ItemRequest $request){
		$data = $this->historicoService->update($request,$request->id);
		return response()->json($data,200);
    }
    
    public function destroy($id){
		$data = $this->historicoService->destroy($id);
		return response()->json($data,200);
    }	
	
}
