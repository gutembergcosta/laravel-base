<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'ref',
        'tipo',
        'user_id',       
        'slug',
        'texto',
        'categoria_id',
        'info',
        'uf',
        'cidade',
        'preco',
        'parent_id',
    ];

    protected $appends = ['data_br'];

    protected $table = 'historico';




    public function setSlug($str)
    {
        $this->attributes['slug'] = slug($str);
    }

    public function databr()
    {
        $this->getDatBR();
    }


    public function getDatBR()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');

    }

    public function scopeProprietario($query)
    {
        return $query->where('user_id', '>', 100);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
