<?php
include_once 'functions/config.php';
function lock_page(){

	session_start();

	if(empty($_SESSION)){
		header('location:'.LOGIN.'?msg=not_logged_in');
	}

}


function logout(){

	session_start();
	unset($_SESSION);
	session_destroy();
	header('location:'.LOGIN);
}

function verify_session(){
	if(!isset($_SESSION)){
		session_start();
	}
}


function check_image($img){


	if (!empty($img["name"])) {
		
		// cria array que irá armazenar os erros, caso existam.
		$error = array();
		
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/(pjpeg|jpeg|png|gif|bmp)/i", $img["type"])){
     	   $error[0] = "Isso não é uma imagem.";
   	 	} 
	
		// Pega as dimensões da imagem
		$dimensoes = getimagesize($img["tmp_name"]);
	
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > MAX_WIDTH) {
			$error[1] = "A largura da imagem deve ser de ".MAX_WIDTH." pixels";
		}

		// Verifica se a altura da imagem é maior que a altura permitida
		if($dimensoes[1] > MAX_HEIGHT) {
			$error[2] = "Altura da imagem deve ser de ".MAX_HEIGHT." pixels";
		}
		
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($img["size"] > MAX_SIZE) {
			$mb = MAX_SIZE / 1000000;
   		 	$error[3] = "A imagem deve ter no máximo ".$mb." MB";
		}

		// Se não houver nenhum erro
		if (count($error) == 0) {
		
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $img["name"], $ext);

        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        	// Caminho de onde ficará a imagem
        	$caminho_imagem = IMG_PATH."/" . $nome_imagem;

			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($img["tmp_name"], $caminho_imagem);
			
			return $nome_imagem;
			
		
		}else{
			return $error;
		}
	

	}else{
		$error[0] = "Nome de arquivo inválido";
		return $error;
	}





}



?>