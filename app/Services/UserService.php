<?php 

namespace App\Services;

use Illuminate\Http\Request;
use App\Actions\BlocosUpload;
use App\Repositories\UserRepository;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UserService 
{
	public function __construct(
		UserRepository $repository,
		BlocosUpload $blocosUpload
		){

		$this->repository				= $repository;
		$this->blocosUpload				= $blocosUpload;
		$this->pagina			= url('painel/usuarios');
		$this->permiteExcluir	= false;


    }

	public function insertBySite($data){

		$data->request->add([
			'tipo'      => 'user',
			'status'    => 'pendente',
			'ref'       => uniqid(),
			'password'  => bcrypt($data->senha),
		]);

		$usuario = $this->repository->insert($data->all());

		$pessoa = DB::table('pessoas')->insert([
            'nome'      => $usuario->name,
            'user_id'   => $usuario->id,
            'tipo'      => $usuario->tipo,
            'ref'       => uniqid(),
        ]);

		if($usuario && $pessoa){
			UserCreated::dispatch($usuario);
		}

		return [
			'msg' => 'Cadastro efetuado com sucesso!',
			'destino' => url(''),
		];

	}

	public function insertByPainel($data){

		$data->request->add([
			'tipo'      => 'user',
			'ref'       => uniqid(),
			'password'  => bcrypt($data->password),
		]);

		$usuario = $this->repository->insert($data->all());

		DB::table('pessoas')->insert([
            'nome'      => $usuario->name,
            'user_id'   => $usuario->id,
            'tipo'      => $usuario->tipo,
            'ref'       => uniqid(),
        ]);

		return [
			'msg' => 'Cadastro efetuado com sucesso!',
			'destino' => route('usuario.lista'),
		];

	}


	

	public function show($id){

		$item = $this->repository->get($id);
		$userData = auth()->user();
		
		$data['pagina']				= $this->pagina;
		$data['permiteExcluir']		= $this->permiteExcluir;
		$data['actionForm']			= $this->pagina.'/update';		
		$data['metodo']				= 'PUT';		
		$data['permiteExcluir']		= ($userData->id == $item['id']) ? false : true;
		$data['dataForm'] 		 	= $item;
		$data['blocoGaleria']  	 	= $this->blocosUpload->exec($item['ref'],'Galeria','galeria','galeria','galeria02');
		$data['blocoImgDestaque']  	= $this->blocosUpload->exec($item['ref'],'Destaque','destaque','img','imagem02');

		return $data;
    } 



	public function validar($userToken){

		$token 	= str_replace('usuario-','',$userToken);
		$email 	= mdx($token, 'd');
		$user 	= $this->repository->getUserPendente($email);

		if(!$user){
			$rs['msg'] 		= 'Usuário não encontrado!';
			$rs['destino'] 	= url('');
		}else{
			$this->repository->validaUsuario($user->id);
			$rs['msg'] 		= 'Usuário validado com sucesso!';
			$rs['destino'] 	= url('login');
		}
		return $rs;
    } 

	public function list(){
		
		$lista = [];
		$matriz		= $this->repository->list();
		$pagina		= $this->pagina;

		foreach ( $matriz as $item ) {
			$item['status'] = $this->htmlLabel($item->status);
			$lista[] = $item;
		};

		return compact(
			'lista',
			'pagina'
		);
    }



	public function tipoLabel($item){
		switch ($item) {
			case "autorizado":
			  return "success";
			  break;
			case "pendente":
			  return "warning";
			  break;
			case "bloqueado":
			  return "danger";
			  break;
			default:
			  return "x";
		  }
	}

	private function htmlLabel($item){

		$nome 		= ucfirst($item);
		$classe 	= $this->tipoLabel($item);

		return "<span class='label label-$classe'>$nome</span>";
	}

	public function dataBr($data){
		return Carbon::parse($data)->format('d/m/Y');
	}

	public function salvarSenha($data){
		$id = (isAdmin()) ? $data->id : auth()->user()->id; 
		$matriz['password'] = bcrypt($data->password);
        $this->repository->update($matriz,$id);

		$rs['msg'] 		= 'Senha alterada com sucesso!';
		$rs['tipo'] 	= 'modal-close';

		return $rs;
    }

	public function deletar($id){
		$this->repository->destroy($id);
		return [
			'msg' => 'Usuário excluído com sucesso!',
			'destino' => $this->pagina,
		];
    }

	public function getByEmail($email){
		return $this->repository->getByEmail($email);
    } 

	public function update(Request $request){
		$this->repository->update($request->all(),$request->id);

		$data['msg'] = 'Usuário atualizado com sucesso!';
		if(isAdmin()){
			$data['destino'] = $this->pagina;
		}

		return $data;
    }


	public function novo(){
		$ref =  uniqid();
		$this->data['dataForm']['ref'] 		= $ref;
		$this->data['actionForm'] 			= $this->pagina.'/insert';
		$this->data['metodo'] 				= 'POST';
		$this->data['blocoGaleria']  		= $this->blocosUpload->exec($ref,'Galeria','galeria','galeria','galeria02');
		$this->data['blocoImgDestaque']  	= $this->blocosUpload->exec($ref,'Destaque','destaque','img','imagem02');
		
		return $this->data;
	}

	////////////////////////////

    public function get($id){

		$item = $this->repository->getByIdTipo($id,'anuncio');
		
		$data['actionForm'] 		= url($this->pagina.'/update');		
		$data['dataForm'] 			= $item;
		$data['blocoGaleria']  		= $this->blocosUpload->exec($item['ref'],'Galeria','galeria','galeria','galeria02');
		$data['blocoImgDestaque']  	= $this->blocosUpload->exec($item['ref'],'Destaque','destaque','img','imagem02');

        return $data;
    } 
    


	
    

	
}
