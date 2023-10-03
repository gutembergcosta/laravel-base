<?php 

namespace App\Services;

use App\Actions\BlocosUpload;
use App\Repositories\HistoricoRepository;

class HistoricoService 
{

	public function __construct(
		HistoricoRepository $historicoRepository,
		BlocosUpload $blocosUpload
	){
		$this->repository	= $historicoRepository;
		$this->blocosUpload	= $blocosUpload;

		$this->data['pagina']			= url('painel/item');
		$this->data['permiteExcluir']	= false;

    }

    public function list($tipo = null){
		$this->data['lista']  	= $this->repository->list($tipo); 
		return $this->data;
    }
    
    
    public function novo(){
		$ref =  uniqid();
		$this->data['dataForm']['ref'] 		= $ref;
		$this->data['actionForm'] 			= $this->data['pagina'].'/insert';
		$this->data['metodo'] 				= 'POST';
		$this->data['blocoGaleria']  		= $this->blocosUpload->exec($ref,'Galeria','galeria','galeria','galeria02');
		$this->data['blocoImgDestaque']  	= $this->blocosUpload->exec($ref,'Destaque','destaque','img','imagem02');
		return $this->data;
	}
 
    public function insert($data){

		$data['slug'] = slug($data->nome);

		try {
			$this->repository->insert($data->all());


			return [
				'msg' => 'Item inserido com sucesso!',
				'destino' => $this->data['pagina'],
			];
		} catch (Exception $e) {
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update post data');
        }

	}
    
    public function show($id){

		$item = $this->repository->getByIdTipo($id,'anuncio');
		
		$this->data['actionForm'] 		 = $this->data['pagina'].'/update';		
		$this->data['metodo'] 			 = 'PUT';		
		$this->data['dataForm'] 		 = $item;
		$this->data['blocoGaleria']  	 = $this->blocosUpload->exec($item['ref'],'Galeria','galeria','galeria','galeria02');
		$this->data['blocoImgDestaque']  = $this->blocosUpload->exec($item['ref'],'Destaque','destaque','img','imagem02');

        return $this->data;
    } 
    
    public function update($data){
		$data = $this->repository->update($data->all(),$data->id);

		return [
			'msg' => 'Item atualizado com sucesso!',
		];
    }
    
    public function destroy($id){
		$this->repository->destroy($id);
		return [
			'msg' => 'Item excluído com sucesso!',
		];
    }


	public function ajaxList($request){

		$totalRecords = $this->repository->qte();

		$data = $this->repository->ajaxList($_POST); 
		$data = $data->map(function ($item) {

			$editLink = route('item.edit',$item['id']);
			$deleteLink = trim(route('item.delete', ['id' => $item['id']]));

			$matriz['Nome'] = "<a class='tb_link' href='$editLink'>{$item['nome']}</a>";
			$matriz['Actions'] = "<a data-url='$deleteLink'  class='btn btn-danger btn-xs deletar'>Excluir</a>";
			return $matriz;
		});

		$totalRecordwithFilter = count($data);

		## Response
		$response = array(
			"draw" => intval($request->draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordwithFilter,
			"aaData" => $data
		);

		echo json_encode($response);


		///=================
		
	  

    }
	
}
