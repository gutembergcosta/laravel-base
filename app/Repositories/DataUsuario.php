<?php

namespace App\Repositories;
use App\Models\Usuario; 

class DataUsuario
{

    public function __construct(){
        $this->usuario = new Usuario();
    }

    public function insert($data){
        $this->usuario::Create($data);
        mensagem('sucesso',BASE_URL.'/painel/usuarios/');
    }

    public function update($data,$id){
        $this->usuario::where('id', $id)->update($data);
        mensagem('sucesso',BASE_URL.'/painel/usuarios/');
    }

    public function delete($id){
        $this->usuario::where('id', $id)->delete();
        $msg['texto'] = 'Item excluído com sucesso';
		mensagem('deletado');
    }

    public function getById($id)
    {
        return $this->usuario::where('id', $id)->first();
    }

    public function load()
    {
        return $this->usuario::all();
    }

    public function getByEmail($email)
    {
        return $this->usuario::where('email', $email)->first();
    }

    public function verificaUser($email,$senha)
    {
        return $this->usuario::where('email', $email)->where('senha', $senha)->first();
    }
    

    
}