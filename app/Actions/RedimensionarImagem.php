<?php 

namespace App\Actions;

class RedimensionarImagem
{

    private function resize_image($fonte, $nome, $largura, $pasta_destino) {

        $info = getimagesize($fonte);
        $mime = $info['mime'];

        switch ($mime) {
                case 'image/jpeg':
                        $image_create_func = 'imagecreatefromjpeg';
                        $image_save_func = 'imagejpeg';
                        $new_image_ext = 'jpg';
                        break;

                case 'image/png':
                        $image_create_func = 'imagecreatefrompng';
                        $image_save_func = 'imagepng';
                        $new_image_ext = 'png';
                        break;

                case 'image/gif':
                        $image_create_func = 'imagecreatefromgif';
                        $image_save_func = 'imagegif';
                        $new_image_ext = 'gif';
                        break;

                default: 
                        throw new Exception('Unknown image type.');
        }

        $img = $image_create_func($fonte);
        list($width, $height) = getimagesize($fonte);

        $altura = ($height / $width) * $largura;
        $nova = imagecreatetruecolor($largura, $altura);
        imagealphablending($nova, false);
        imagesavealpha($nova,true);
        $transparent = imagecolorallocatealpha($nova, 255, 255, 255, 127);
        imagefilledrectangle($nova, 0, 0, $largura, $altura, $transparent);
        imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $width, $height);

        if (file_exists($nome)) {
                unlink($nome);
        }
        $image_save_func($nova, "$pasta_destino/$nome");
    }


    function square_image( $source_file, $dst_dir, $max_width, $max_height){

        $imgsize = getimagesize($source_file);
    
        // var_dump($imgsize );
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];
    
        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;
    
            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                //$quality = 7;
                break;
    
            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                //$quality = 100;
                break;
    
            default:
                return false;
                break;
        }
    
        $dst_img = imagecreatetruecolor($max_width, $max_height);
    
        if($mime == "image/png" or $mime == "image/gif"){
            imagecolortransparent($dst_img, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
            imagealphablending($dst_img, false);
            imagesavealpha($dst_img, true);
            }
    
        $src_img = $image_create($source_file);
    
        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
            
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
            
        }
    
        $image($dst_img, $dst_dir);
    
        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
    }
    
}
