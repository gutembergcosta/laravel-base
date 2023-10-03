<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\CarbonHelper;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

  
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'tipo',
        'ref',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['data_br'];


    public function getDataBrAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }


    // Relacionamentos
    public function Pessoa()
    {
        return $this->hasOne(Pessoa::class); 
    }
}
