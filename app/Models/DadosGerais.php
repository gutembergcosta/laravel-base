<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Repositories\DataArquivo;

class DadosGerais extends Model
{

    public function __construct(){
		parent:: __construct(); 
     
        $this->carbon 		= new Carbon;
        $this->dataArquivo 		= new DataArquivo;
    }

    protected $fillable = [
        'nome',
        'tel01',
        'tel02',
        'tel03',
        'user_id',
        'slug',
        'texto_apresentacao',
        'endereco_linha',
        'endereco_full',
    ];

    protected $table = 'dados_gerais';

    // Relacionamentos =======================

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class, 'ref', 'ref'); //'foreign_key', 'local_key'
    }

    

    // Mutators =====================



    // Accessors =====================

    public function getZapNumeroAttribute()
    {
        $numero = $this->tel_01;
        return getNumeros($numero);
    }

    public function getDataPtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y');
    }

    public function getResumoAttribute()
    {
        return resumir($this->texto,10); 
    }

    public function getQteImagensAttribute()
    {
        return $this->dataArquivo->getByRef($this->ref)->count(); 
    }

    public function getFirstImgGaleriaAttribute()
    {
        return $this->arquivos->first()->arquivo;
    }

    public function getGaleriaAttribute()
    {
        return $this->arquivos->where('ref', $this->ref);
    }

    public function getImgDestaqueAttribute()
    {
        return $this->arquivos->where('ref', $this->ref)->where('tipo', 'destaque');
    }
}