<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'user_id',
        'tipo',
        'nome',
        'rg',
        'cpf',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'nascimento',
        'zap',
        'list',
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'categoria_user',
        'pago',
        'ref',
        'telefone',
        'bloqueado',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

}
