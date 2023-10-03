<?php
    namespace App\Libraries;

    class Validation {
        
        public $patterns = array(
            'uri'           => '[A-Za-z0-9-\/_?&=]+',
            'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
            'alpha'         => '[\p{L}]+',
            'words'         => '[\p{L}\s]+',
            'alphanum'      => '[\p{L}0-9]+',
            'int'           => '[0-9]+',
            'float'         => '[0-9\.,]+',
            'tel'           => '[0-9+\s()-]+',
            'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
            'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
            'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
            'address'       => '[\p{L}0-9\s.,()°-]+',
            'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
            'date_ymd'      => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
            'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]'
        );
        
        
        public $errors = array();

        
        public function name($name){

            $this->name = $name;
            return $this;
        
        }
        
        public function value($value){
            
            $this->value = trim($value);
            return $this;
        
        }
        
        
        public function file($value){
            
            $this->file = $value;
            return $this;
        
        }
        
        public function pattern($name){
            
            if($name == 'array'){
                
                if(!is_array($this->value)){
                    $this->errors[] = 'O formato do campo '.$this->name.' não é válido';
                }
            
            }else{
            
                $regex = '/^('.$this->patterns[$name].')$/u';
                if($this->value != '' && !preg_match($regex, $this->value)){
                    $this->errors[] = 'O formato do campo '.$this->name.' não é válido.';
                }
                
            }
            return $this;
            
        }
        
        
        public function customPattern($pattern){
            
            $regex = '/^('.$pattern.')$/u';
            if($this->value != '' && !preg_match($regex, $this->value)){
                $this->errors[] = 'O formato do campo '.$this->name.' não é válido.';
            }
            return $this;
            
        }
        
        public function required($alias =  false){

            if($alias) $this->name = $alias;

            if((isset($this->file) && $this->file['error'] == 4) || ($this->value == '' || $this->value == null)){
                $this->errors[] = 'O campo '.$this->name.' é obrigatório.';
            }            
            return $this;
        }
        
        
        public function min($length){
            
            if(is_string($this->value)){
                
                if(strlen($this->value) < $length){
                    $this->errors[] = 'O valor do campo '.$this->name.' é inferior ao valor mínimo';
                }
           
            }else{
                
                if($this->value < $length){
                    $this->errors[] = 'O valor do campo '.$this->name.' é inferior ao valor mínimo';
                }
                
            }
            return $this;
            
        }
        
            
        
        public function max($length){
            
            if(is_string($this->value)){
                
                if(strlen($this->value) > $length){
                    $this->errors[] = 'O valor do campo '.$this->name.' é superior ao valor máximo';
                }
           
            }else{
                
                if($this->value > $length){
                    $this->errors[] = 'O valor do campo '.$this->name.' é superior ao valor máximo';
                }
                
            }
            return $this;
            
        }
        
        
        public function equal($value){
        
            if($this->value != $value){
                $this->errors[] = 'O valor do campo '.$this->name.' não corresponde.';
            }
            return $this;
            
        }

        
        public function maxSize($size){
            
            if($this->file['error'] != 4 && $this->file['size'] > $size){
                $this->errors[] = 'O arquivo '.$this->name.' supera o tamanho máximo de  '.number_format($size / 1048576, 2).' MB.';
            }
            return $this;
            
        }
        
        
        public function ext($extension){

            if($this->file['error'] != 4 && pathinfo($this->file['name'], PATHINFO_EXTENSION) != $extension && strtoupper(pathinfo($this->file['name'], PATHINFO_EXTENSION)) != $extension){
                $this->errors[] = 'O arquivo '.$this->name.' não possui a extensão '.$extension.'.';
            }
            return $this;
            
        }
        
        
        public function purify($string){
            return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }
        
        
        public function isSuccess(){
            if(empty($this->errors)) return true;
        }
        
        
        public function getErrors(){
            if(!$this->isSuccess()) return $this->errors;
        }

        public function addValidation($msg){
            if($msg){
                $this->errors[] = $msg;
            }
        }
        
        
        public function displayErrors($extras = []){
            
            $html = '<ul>';
                foreach($this->getErrors() as $error){
                    $html .= '<li>'.$error.'</li>';
                }
            $html .= '</ul>';
            
            return $html;
            
        }
        public function displayJsonErrors($extras = []){
            $frmData['errors'] = $this->getErrors();
            echo json_encode($frmData); exit;
        }
        
        
        public function result(){
            
            if(!$this->isSuccess()){
               
                foreach($this->getErrors() as $error){
                    echo "$error\n";
                }
                exit;
                
            }else{
                return true;
            }
        
        }
        
        public static function is_int($value){
            if(filter_var($value, FILTER_VALIDATE_INT)) return true;
        }
        
        public static function is_float($value){
            if(filter_var($value, FILTER_VALIDATE_FLOAT)) return true;
        }
        
        public static function is_alpha($value){
            if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z]+$/")))) return true;
        }


        public static function is_alphanum($value){
            if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[a-zA-Z0-9]+$/")))) return true;
        }
        
        public static function is_url($value){
            if(filter_var($value, FILTER_VALIDATE_URL)) return true;
        }
        
        public static function is_uri($value){
            if(filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => "/^[A-Za-z0-9-\/_]+$/")))) return true;
        }
        
        public static function is_bool($value){
            if(is_bool(filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE))) return true;
        }
        
        public static function is_email($value){
            if(filter_var($value, FILTER_VALIDATE_EMAIL)) return true;
        }
        
    }