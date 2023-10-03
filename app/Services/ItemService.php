<?php 

namespace App\Services;

use App\Actions\BlocosUpload;
use App\Repositories\ItemRepository;
use DataTables;

class ItemService 
{

	public function __construct(
		ItemRepository $itemRepository,
		BlocosUpload $blocosUpload
	){
		$this->repository	= $itemRepository;
		$this->blocosUpload	= $blocosUpload;

		$this->pagina			= url('painel/item');
		$this->permiteExcluir	= false;

    }

    public function list($tipo = null){
		$pagina		= $this->pagina;
		$lista  	= $this->repository->list($tipo); 
		return compact('lista','pagina');
    }
    
    
    public function novo(){
		$ref 				=  uniqid();
		$pagina				= $this->pagina;
		$permiteExcluir		= $this->permiteExcluir;
		$actionForm 		= $this->pagina.'/insert';
		$metodo 			= 'POST';
		$blocoGaleria  		= $this->blocosUpload->exec($ref,'Galeria','galeria','galeria','galeria02');
		$blocoImgDestaque  	= $this->blocosUpload->exec($ref,'Destaque','destaque','img','imagem02');

		return compact('ref' ,'pagina','permiteExcluir','actionForm','metodo','blocoGaleria','blocoImgDestaque');
	}
 
    public function insert($data){

		$data['slug'] = slug($data->nome);

		try {
			
			$this->repository->insert($data->all());

			return [
				'msg' => 'Item inserido com sucesso!',
				'destino' => $this->pagina,
			];
		} catch (Exception $e) {
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update post data');
        }

	}
    
    public function show($id){

		$item 				= $this->repository->getById($id);
		$ref 				= $item->ref;
		$pagina				= $this->pagina;
		$permiteExcluir		= $this->permiteExcluir;
		$actionForm 		= $this->pagina.'/update';
		$metodo 			= 'PUT';		
		$dataForm 		 	= $item;
		$blocoGaleria  	 	= $this->blocosUpload->exec($item->ref,'Galeria','galeria','galeria','galeria02');
		$blocoImgDestaque 	= $this->blocosUpload->exec($item->ref,'Destaque','destaque','img','imagem02');
   		
		return compact('item','ref','actionForm','metodo','dataForm','blocoGaleria','blocoImgDestaque','pagina','permiteExcluir');
    } 
    
    public function update($data){
		$data = $this->repository->update($data->all(),$data->id);

		return [
			'msg' => 'Item atualizado com sucesso!',
			'destino' => $this->pagina,
		];
    }
    
    public function destroy($id){
		$this->repository->destroy($id);
		return [
			'msg' => 'Item excluído com sucesso!',
		];
    }


	

	public function getDataTable($request){

		if ($request->ajax()) {
            $data = $this->repository->list();
            return Datatables::of($data)
                ->addIndexColumn()
				->addColumn('link', function($row){
					$url = route('item.edit',[$row->id]);
                    $actionBtn = "<a class='tb_link' href='$url'>{$row->nome}</a>";
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
					$url = route('item.delete',[$row->id]);
                    $actionBtn ="<a data-url='{$url}' class='btn btn-danger btn-xs deletar'>Excluir</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action','link'])
                ->make(true);
        }
	}
	
}
