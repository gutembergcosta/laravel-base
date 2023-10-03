<?php

namespace App\Helpers;
use Carbon\Carbon;


class CarbonHelper
{

    public static function getDataBr($data)
    {
        
        return Carbon::parse($data)->format('d/m/Y');
    }

}



