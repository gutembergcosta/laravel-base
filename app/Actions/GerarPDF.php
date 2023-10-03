<?php

namespace App\Actions;
use Mpdf\Mpdf;

class GerarPDF
{

    public function __construct(){
        $this->mpdf = new Mpdf();
    }

    public function execute($data){

        
        $this->mpdf->WriteHTML("<h1>{$data['texto']}</h1>");
        $this->mpdf->Output();

    }
}



