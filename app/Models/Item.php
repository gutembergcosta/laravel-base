<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Item extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

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

    protected $table = 'item';

    public function setSlug($str)
    {
        $this->attributes['slug'] = slug($str);
    }

    // Scopes

    public function scopeProprietario($query)
    {
        return $query->where('user_id', '>', 100);
    }

}
