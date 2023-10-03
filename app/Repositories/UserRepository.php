<?php

namespace App\Repositories;
use App\Models\User; 

class UserRepository
{

    public function get($id){
        return User::find($id);
    }

    public function insert($data){
		return User::create($data);
    }

    public function getUserPendente($email){
        return User::where('email', $email)->where('status', 'pendente')->where('tipo', 'user')->first();
    }

    public function validaUsuario($id){
        $item = User::find($id);
        return $item->update(['status' => 'autorizado']);
    }
    
    public function list(){
        return User::where('id','!=',1)->get();
    }

    public function listByTipo($tipo){
        return User::where('tipo', $tipo)->get();
    }

    public function getByEmail($email){
        return User::where('email', $email)->first();
    }

    public function update($data,$id){
        return User::where('id', $id)->update($data);
    }
    
    public function destroy($id){
        User::destroy($id);
    }

    public function getByIdTipo($id,$tipo){
        return User::where('tipo', $tipo)->where('id', $id)->first();
    }

    public function getById($id){
        return User::find($id);
    }

    public function getBySlug($slug){
        return User::where('slug', $slug)->first();
    }

    public function listUser(){
        return User::where('tipo', 'anuncio')->where('user_id',getUserId())->get();
    }

    

    public function listByUF($uf){
        return User::where('uf', $uf)->get();
    }
    
}