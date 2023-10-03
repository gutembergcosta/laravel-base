<?php

namespace App\Observers;

use App\Models\Arquivo;

class ArquivoObserver
{
    
    public function deleting(Arquivo $arquivo)
    {
        $prefixos = ['thumb', 'max', 'original', 'mini', 'slide'];

        foreach ($prefixos as $prefixo) {
            $filename = "uploads/" . $prefixo . '-' . $arquivo->arquivo;
            if (file_exists($filename)) {
                unlink($filename);
            }
        }
    }
}
