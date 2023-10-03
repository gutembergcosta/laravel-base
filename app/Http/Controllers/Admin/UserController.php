<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Actions\BlocosUpload;
use App\Services\UserService;
use App\Http\Requests\CadastroRequest;
use App\Http\Requests\AtualizaSenhaRequest;
use Illuminate\Http\Request;



class UserController extends Controller
{

    public function __construct(
		BlocosUpload $blocosUpload,
		UserService $userService
	){
		parent:: __construct(); 

		$this->blocosUpload	= $blocosUpload;
		$this->userService	= $userService;

    }

    public function lista(){
		$data = $this->userService->list();
		return view('painel.user.lista', $data );
		
    }
    public function ajaxList(Request $request){
		return $this->userService->ajaxList($request);
    }
    
    public function novo(){
		$data = $this->userService->novo();
		return view('painel.user.formulario-add', $data );
    }
 
    public function insert(CadastroRequest $request){
		$data = $this->userService->insertByPainel($request);
		return response()->json($data,200);
    }
    
    public function show($id){
		$data = $this->userService->show($id);
		return view('painel.user.formulario', $data );
    } 

    public function perfil(){
		$user_id = auth()->user()->id;
		return $this->show($user_id);
    } 
    
    public function update(CadastroRequest $request){
		$data = $this->userService->update($request);
		return response()->json($data,200);
    }

    public function salvarSenha(AtualizaSenhaRequest $request){
		$data = $this->userService->salvarSenha($request);
		return response()->json($data,200);
    }
    
    public function destroy($id){
		$data = $this->userService->deletar($id);
		return response()->json($data,200);
    }	
	
}
