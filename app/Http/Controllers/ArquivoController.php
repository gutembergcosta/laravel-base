<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ArquivoRepository;
use App\Actions\UploadArquivo;



class ArquivoController extends Controller
{
    public function __construct(){
        parent::__construct();

        $this->arquivoRepository = new ArquivoRepository;

        $this->uploadArquivo = new UploadArquivo;
    }

    public function insert(Request $request){
        
        $data = $this->uploadArquivo->upload($request);

        $this->arquivoRepository->insert($data->request);

        return response()->json($data,200);
        
        
    }

    public function destroy($item){
        $status = 1;
        $this->arquivoRepository->excluirArquivo($item);
        echo json_encode($status);
    }
}
