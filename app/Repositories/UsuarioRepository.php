<?php

namespace App\Repositories;
use App\Models\Usuario; 

class UsuarioRepository
{

    public function insert($data){
		Usuario::create($data->all());
    }

    public function update($data,$id){
        $item = Usuario::find($id);
        $item->update($data->all());
    }

    public function destroy($id){
        $item   = Usuario::find($id);
        $item->delete();
    }

    public function list(){
        return Usuario::all();
    }

    public function getByIdTipo($id,$tipo){
        return Usuario::where('tipo', $tipo)->where('id', $id)->first();
    }

    public function getById($id){
        return Usuario::find($id);
    }

    public function getBySlug($slug){
        return Usuario::where('slug', $slug)->first();
    }

    public function listUsuario(){
        return Usuario::where('tipo', 'anuncio')->where('user_id',getUserId())->get();
    }

    public function listByCategoriaId($categoriaId){
        return Usuario::where('categoria_id', $categoriaId)->get();
    }

    public function listByUF($uf){
        return Usuario::where('uf', $uf)->get();
    }
    
}