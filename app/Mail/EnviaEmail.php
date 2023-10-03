<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviaEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    private $viewFile;
    private $assunto;
    

    public function __construct($data,$viewFile,$assunto)
    {
        $this->data = $data;
        $this->viewFile = "emails.$viewFile";
        $this->assunto = $assunto;
    }

    public function build()
    {
        return $this->subject($this->assunto)->view($this->viewFile);
    }
}
