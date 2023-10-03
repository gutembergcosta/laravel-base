<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DbHelper
{

    public function getDB($tabela,$coluna,$item){
		return DB::table($tabela)->where($coluna,$item)->get();
	}

    public function save($tabela,$matriz,$id = null){
		return DB::table($tabela)->updateOrInsert($matriz,['id' => $id]);
	}

    public function addLog($acao,$tabela,$ref_id = null,$texto = null ){

        $user_id = (auth()->user()) ? auth()->user()->id : 0;

		return DB::table('historico')->insert([
            'acao'          => $acao,
            'tabela'        => $tabela,
            'user_id'       => $user_id,
            'ref_id'        => $ref_id,
            'texto'         => $texto,
            'created_at'    => Carbon::now(),
        ]);
	}

}



