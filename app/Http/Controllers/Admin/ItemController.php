<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Actions\BlocosUpload;
use App\Services\ItemService;
use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;




use DbHelper;

class ItemController extends Controller
{
	public function __construct(
		BlocosUpload $blocosUpload,
		ItemService $itemService
	){
		parent:: __construct(); 

		$this->blocosUpload	= $blocosUpload;
		$this->itemService	= $itemService;

    }

    public function lista(){
		$data = $this->itemService->list('anuncio');

		
		return view('painel.item.lista', $data );
		
    }
   
    
    public function novo(){
		$data = $this->itemService->novo();
		return view('painel.item.formulario', $data );
    }
 
    public function insert(ItemRequest $request){
		$data = $this->itemService->insert($request);
		return response()->json($data,200);
    }
    
    public function show($id){
		$data = $this->itemService->show($id);
		return view('painel.item.formulario', $data );
    } 
    
    public function update(ItemRequest $request){
		$data = $this->itemService->update($request,$request->id);
		return response()->json($data,200);
    }
    
    public function destroy($id){
		$data = $this->itemService->destroy($id);
		return response()->json($data,200);
    }	

	public function getDataTable(Request $request)
    {
		return $this->itemService->getDataTable($request);
        
    }
	
}
