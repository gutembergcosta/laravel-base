<?php 

namespace App\Actions;
use Gumlet\ImageResize;
use App\Repositories\ArquivoRepository;

class UploadArquivo
{

    public function upload($data){

        if (isset($data['unico']) && $data['unico'] != '') {
            $arquivo = new ArquivoRepository;
            $arquivo->excluirArquivo($data['unico']);
        }

        $fileTmpPath    = $_FILES['myfile']['tmp_name'];
        $fileName       = $_FILES['myfile']['name'];
        $fileSize       = $_FILES['myfile']['size'];
        $fileType       = $_FILES['myfile']['type'];
        $fileNameCmps   = explode(".", $fileName);
        $fileExtension  = strtolower(end($fileNameCmps));

        $newFileName = uniqid() . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = 'uploads/';

            $dest_path = $uploadFileDir . 'original-' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {


                $this->resizer($dest_path, $uploadFileDir, $newFileName, 800, 'max');
                $this->crop($dest_path, $uploadFileDir, $newFileName, 350,350, 'thumb');
                if($data['tipo'] ==  'slide'){
                    $this->crop($dest_path, $uploadFileDir, $newFileName, 2000, 800, 'slide');
                }

                $data['arquivo']        = $newFileName;
                $data['nome']           = $fileNameCmps[0];
                $data['miniatura']      = url('uploads/thumb-' . $newFileName);
                $data['max']            = url('uploads/max-' . $newFileName);

                return $data;
                
            } else {
                die('erro');
                
            }
        }
    }

    private function resizer($dest_path, $uploadFileDir, $newFileName, $size, $prefixo){
        $imageResize = new ImageResize($dest_path);
        $imageResize->resizeToWidth($size);
        $imageResize->save($uploadFileDir . $prefixo . '-' . $newFileName);
    }

    private function crop($dest_path, $uploadFileDir, $newFileName, $largura,$altura, $prefixo){
        $imageResize = new ImageResize($dest_path);
        $imageResize->crop($largura, $altura, true, ImageResize::CROPCENTER);
        $imageResize->save($uploadFileDir . $prefixo . '-' . $newFileName);
    }
    
}
