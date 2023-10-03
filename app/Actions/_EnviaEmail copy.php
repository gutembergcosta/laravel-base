<?php

namespace App\Actions;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Libraries\Twig;

class EnviaEmail
{

    public function __construct(){
        $this->email    = new PHPMailer(true);
        $this->twig     = new Twig;
    }

    public function execute($tipo,$data){

        try {

            if($tipo == 'mensagem'){

                $textoMsg = 'Email enviado com susceso!';
                $emailTemplate = Twig::render('partials/mensagem-base.htm', $data, true);

                $this->serverSettings();
                $this->recipients(EMAIL_SITE,'Site');
                $this->textoMensagem('Mensagem do site',$emailTemplate);
            }

            if($tipo == 'cadastro'){

                $textoMsg = 'Cadastro realizado com susceso!';
                $emailTemplate = Twig::render('partials/mensagem-cadastro.htm', $data, true);

                $this->serverSettings();
                $this->recipients($data['email'],'Site');
                $this->textoMensagem('Novo cadastro',$emailTemplate);
            }
  
            if($this->email->send()){
                mensagem($textoMsg, 'reload');
            }
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->email->ErrorInfo}";
        }

    }

    private function serverSettings(){
        //Server settings
        $this->email->SMTPDebug  = 0;                               //Enable verbose debug output
        $this->email->isSMTP();                                     //Send using SMTP
        $this->email->Host       = SMTP_SERVER;                     //Set the SMTP server to send through
        $this->email->SMTPAuth   = SMTP_AUTH;                       //Enable SMTP authentication
        $this->email->Username   = SMTP_USERNAME;                   //SMTP username
        $this->email->Password   = SMTP_PASSWORD;                   //SMTP password
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     //Enable implicit TLS encryption
        $this->email->Port       = SMTP_PORT;                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }

    private function recipients($emailDestino,$nome ){
        //Recipients
        $this->email->setFrom(SMTP_FROM, SMTP_NAME);
        $this->email->addAddress($emailDestino, $nome);     //Add a recipient
    
                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    }
    

    private function anexos(){
        //Attachments
        $this->email->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $this->email->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    }



    private function textoMensagem($assunto, $texto){
         //Content
         $this->email->isHTML(true);                                  //Set email format to HTML
         $this->email->Subject = $assunto;                  
         $this->email->Body    = $texto;
         //$this->email->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }


    

}



