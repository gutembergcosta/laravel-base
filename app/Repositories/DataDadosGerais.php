<?php 
namespace App\Repositories;
use App\Models\DadosGerais; 

class DataDadosGerais
{

    public function __construct(){
        $this->dadosGerais = new DadosGerais();
    }

    public function update($data){

        $item = $this->dadosGerais::find(1);
        $item->fill($data);
        $item->setUserId();
        $item->save();

    }

    public function get(){
        return $this->dadosGerais::find(1);
    }



    //== OLD ===================================
 
    public function infos()
    {
        $data = [
            'tel01'         => '31 9307-9053',
            'tel02'         => '31 9307-9053',
            'tel03'         => '31 9307-9053',
            'zap'           => '3193079053',
            'email'         => 'contato@agroruralclassificados.com.br',
            'enderecoLinha' => 'Av. Dom Pedro I, 2053 - Planalto, BH - MG',
            'enderecoFull'  => 'Av. Dom Pedro I, 2053 <br> Planalto, Belo Horizonte - MG, <br>30710-010',
        ];
        return $data;
    }
    public function redesSociais()
    {
        $data = [
            'instagram'     => 'https://www.instagram.com/',
            'facebook'      => 'https://www.facebook.com/',
            'twitter'       => 'https://www.twitter.com/',
            'youtube'       => 'https://www.youtube.com/',
        ];
        return $data;
    }
}