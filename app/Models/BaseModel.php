<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class BaseModel extends Model
{

    public function getDataBr($data)
    {
        return Carbon::parse($data)->format('d/m/Y');
    }


}
