<?php

	function teste(){
		echo 'x'; exit;
	}

    
	function htmlParser($arquivo,$data = []) {

		$html = file_exists($arquivo) ? file_get_contents($arquivo) : '';

		$chaves = array_keys($data);
		$chaves = array_map(function($item){
			return '{{'.$item.'}}';
		},$chaves);
	
		return str_replace($chaves,array_values($data),$html);

	}


    function extrairFields($my_array, $allowed){
        return array_intersect_key($my_array, array_flip($allowed));
    }

	function x($variavel,$default = NULL){

		return (isset($variavel)) ?: $default;

	}

	function isMobile() {
		
		if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
			$is_mobile = false;
		} elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Mobile' ) !== false // Many mobile devices (all iPhone, iPad, etc.)
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Silk/' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) !== false ) {
				$is_mobile = true;
		} else {
			$is_mobile = false;
		}
	
		return $is_mobile;
	}

	function isAdmin(){
		return (auth()->user()->tipo == 'admin') ? true : false; 
	}

	function slug($str){


		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') ){
			$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
		}
				
		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
		$str = strtolower( trim($str, '-') );
		$str = substr($str, 0, 100);
		return $str;

	}

	function baseUrl(){
		$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$url .= "://".$_SERVER['HTTP_HOST'];
		$url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		return $url;
	}

	function fullUrl(){
		$verboHTTP = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		return $verboHTTP . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}

	function mensagemx($data,$destino = ''){

		$rs['status'] = 200;

		if(is_array($data)){
			$rs['status'] = 422;
			if(isset($data['errors'])) $rs['errors'] = $data['errors'];
		}

		if(is_string($data)){
			$rs['msg'] = $data;
		}

		if($data == 'sucesso'){
			$rs['msg'] = 'Item salvo com sucesso';
		}

		if($data == 'deletado'){
			$rs['msg'] = 'Item excluído com sucesso';
		}

		if($data == 'erro-login'){
			$rs['status'] = 422;
			$rs['msg'] = 'Erro ao acessar';
		}

		if($destino != ''){
			$rs['destino'] = $destino;
		}

		return $rs;

		

    }

	function mdx( $str, $action = 'e' ) {
		// you may change these values to your own
		$secret_key = 'asx';
		$secret_iv = 'asx';
	
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	
		if( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt( $str, $encrypt_method, $key, 0, $iv ) );
		}
		else if( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $str ), $encrypt_method, $key, 0, $iv );
		}
	
		return $output;
	}

	function convertePreco($numero,$destino){

		if($destino == "double"){       
			$numero = preg_replace('/[^0-9]/', '', "$numero")/100;
		}
	
		if($destino == "int"){       
			$numero = preg_replace('/[^0-9]/', '', "$numero")/100;
		}
	
		if($destino == "site"){       
			if($numero == 0){
				$numero = 0.00;
			}
			$numero = number_format($numero, 2, ',', '.');
		}
	
		return $numero;
	
	}

	function getNumeros($numero){
		return preg_replace('/[^0-9]/', '', "$numero");
	}


	function token(){

		$token = "";
	
		//$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		for ($i = 0; $i < 5; $i++) {
			$token .= $characters[rand(0, $charactersLength - 1)];
		}
	
		$token01 =  uniqid();
	
		return "$token$token01";
	}

	function getUserId(){
		return "1";
		//return $_SESSION["user"]['id'];
	}

	function getUserTipo(){
		return $_SESSION["user"]['tipo'];
	}

	function gerarSToken(){
		
		if(!isset($_SESSION['csrf-token'])){
			$token = md5(uniqid(mt_rand(), true));
			$_SESSION['csrf-token'] = $token;
		}
		return   $_SESSION['csrf-token'];
    }

	function verificaSToken(){

        $token = isset($_POST['csrf-token']) ? $_POST['csrf-token'] : false; 

        if (!$token || $token !== $_SESSION['csrf-token']) {
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        } 
    }



	function resumir($string,$caracteres) { 
        $string = strip_tags($string); 
        if (strlen($string) > $caracteres) { 
        while (substr($string,$caracteres,1) <> ' ' && ($caracteres < strlen($string))) { 
            $caracteres++; }; 
        }; 
        return substr($string,0,$caracteres) . '...'; 
    }

	function getFirst($rs){
        return (count($rs) > 0) ? $rs[0] : [];
    }
	function ddlog($str){
        echo "<script>console.log($str)</script>";
    }


	function validarCPF($cpf) {
        // Remover caracteres especiais
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verificar se possui 11 dígitos
        if (strlen($cpf) !== 11) {
            return false;
        }

        // Verificar se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calcular o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += ($cpf[$i] * (10 - $i));
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;

        // Verificar o primeiro dígito verificador
        if ($cpf[9] != $digito1) {
            return false;
        }

        // Calcular o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += ($cpf[$i] * (11 - $i));
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;

        // Verificar o segundo dígito verificador
        if ($cpf[10] != $digito2) {
            return false;
        }

        return true;
    }


?>