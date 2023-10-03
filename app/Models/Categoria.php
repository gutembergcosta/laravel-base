<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Categoria extends Model

{

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'nome',
		'slug',
    ];

    public $timestamps = false;

    // Mutators =====================

    public function setSlug($str)
    {
        $this->attributes['slug'] = slug($str);
    }


 }