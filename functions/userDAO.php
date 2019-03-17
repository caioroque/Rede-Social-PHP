<?php
// inclui conexão com banco de dados
include_once 'DBGateway.php';

/*
LISTA DE FUNÇÕES:
	get_user($user_data);
	validar_login($user_data)
	search_user($search, $name, $user_name)
	add_follower($id_follower, $id_user)
	del_follower($id_follower, $id_user)
	get_followers($id_user)
	register_new_user($user_data, $img)
*/

	
/* 	função: get_user
	descrição: retornar os dados do usuário logado
	parâmetos:
		$user_data: array contendo dados do usuário
	retornos:
		$result: os dados do usuário caso seja encontrado no banco
		null: caso não seja encontrado usuário com os parâmetros recebidos
 */
function get_user($userData){

	// recebe conexão
	$conn = get_connection();

	// busca na tabela especificada se o usuário existe
	$sql = "SELECT * FROM " . USERS . " WHERE user_name LIKE '" .
	$userData['user_name'] . "' AND password LIKE '" . 
	$userData['password'] . "';";

	// recebe resultado da consulta
	$result = mysqli_query($conn, $sql);

	// se a consulta foi bem-sucedida
	if (mysqli_affected_rows($conn) > 0){

		// retorna os dados do usuário encontrado
		return $result;
	}else{
		// retorna nulo
		return null;
	}

}

/* 	função: validar_login
	descrição: 
		realiza o login no sistema caso os dados fornecidos estejam corretos
	parâmetos:
		$user_data: array com os dados do usuário
	retornos: 
		true: se o login for realizado com sucesso
		false: se não foi possível realizar o login
 */
function validar_login($user_data){

	// recebe conexão
	$conn = get_connection();

	// realiza busca na tabela especificada
	$sql = "SELECT * FROM " . USERS . " WHERE user_name LIKE '" .
	$user_data['user_name'] . "' AND password LIKE '" . 
	$user_data['password'] . "';";

	// recebe o resultado da consulta
	$result = mysqli_query($conn, $sql);

	// se a consulta foi bem-sucedida
	if (mysqli_affected_rows($conn) > 0){

		// cria array associativo a partir do resultado
		$user = mysqli_fetch_assoc($result);
		
		// inicia sessão
		session_start();
		// registra variáveis de sessão com os dados do usuário retornado:
		$_SESSION['id_user'] = $user['id_user'];
		$_SESSION['name'] = $user['name'];
		$_SESSION['user_name'] = $user['user_name'];
		$_SESSION['password'] = $user['password'];
		$_SESSION['email'] = $user['email'];
		$_SESSION['id_followers'] = $user['id_followers'];

		// usuário logado
		return true;
	}else{
		// usuário não logado
		return false;
	}

}

/* 	função: search_user
	descrição: 
		procura por usuário(s) no sistema
	parâmetos:
		$search: termo da busca
		$name: nome do usuário logado
		$user_name: nome de usuário do usuário logado
	retornos: 
		$result: usuários retornados pela busca
		null: caso a busca não retorne nada
 */
function search_user($search, $name, $user_name){

	// recebe conexão
	$conn = get_connection();

	// realiza busca na tabela especificada excluindo da pesquisa o proprio usuario logado
	$sql = "SELECT id_user, name, user_name FROM ".USERS." WHERE (name LIKE '%$search%' OR user_name LIKE '%$search%') AND (name NOT LIKE '$name' OR user_name NOT LIKE '$user_name')";

	// recebe o resultado da consulta
	$result = mysqli_query($conn, $sql);

	// se a consulta foi bem-sucedida
	if(mysqli_affected_rows($conn) > 0){
		// retorna o resultado da consulta
		return $result;
	}else{
		// retorna nulo
		return null;
	}

}

/* 	função: add_follower
	descrição: 
		adicina o usuário especificado aos usuários seguidos
	parâmetos:
		$id_follower: id do usuário que deseja seguir
		$id_user: id do usuário logado
	retornos: 
		true: se foi adicionado seguidor com sucesso
		false: se houve erro ao seguir usuário
 */
function add_follower($id_follower, $id_user){

	// recebe conexão
	$conn = get_connection();

	// realiza busca na tabela especificada
	$sql = "SELECT id_followers FROM ".USERS." WHERE id_user = $id_user";
	// recebe o resultado da consulta
	$result = mysqli_query($conn, $sql);

	// bolleana que definirá se o usuário logado receberá uma atualização de seguidores ou não
	$go_to_update = false; // inicialmente não prosseguirá com a atualização

	// se a consulta foi bem-sucedida
	if(mysqli_affected_rows($conn) > 0){

		// transforma resultado em um array associativo
		$collum_id_followers = mysqli_fetch_assoc($result);

		// armazena o valor do array associativo criado em uma string
		$ids_string = $collum_id_followers['id_followers'];

		// se esssa string não estiver vazia, significa que o usuário logado já segue outros usuários
		if($ids_string != ''){
			// concatena com o valor da variável uma vírgula e o id do usuário que se deseja seguir
			$ids_string .= ",$id_follower";
		}else{
			// senão, significa que o usuário lgado não segue ninguém. Logo, este será o primeiro usuário a ser seguido. 

			// string recebe SOMENTE o id do usuário que se dseja seguir, sem a virgula na frente.
			$ids_string = $id_follower;
		}

		// pode prosseguir com a atualização:
		$go_to_update = true;

	}

	// se for permitido prosseguir com a atualização:
	if($go_to_update){

		// cria comando de update
		$sql = "UPDATE ". USERS . " set id_followers = '$ids_string' WHERE id_user = $id_user";

		// armazena resultado do comando
		$result = mysqli_query($conn, $sql);

		// se o comando foi bem-sucedido:
		if(mysqli_affected_rows($conn) > 0){
			// atualiza seguidores na variável de sessão:
			if(!isset($_SESSION)){
				session_start();
			}
			$_SESSION['id_followers'] = $ids_string;

			// seguidor adicionado com sucesso:
			return true;
		}else{
			// erro ao adicionar seguidor
			return false;
		}
	
	}else{
		// erro ao encontrar seguidor na tabela de usuários
		return false;
	}


}

/* 	função: del_follower
	descrição: 
		retira seguidor específico da lista de seguidores
	parâmetos:
		$id_follower: o id do usuário que deseja deixar de seguir
		$id_user: id do usuário logado
	retornos: 
		true: se foi adicionado seguidor com sucesso
		false: se houve erro ao seguir usuário
 */
function del_follower($id_follower, $id_user){

	// recebe conexão
	$conn = get_connection();

	// realiza consulta na tabela especificada
	$sql = "SELECT id_followers FROM ".USERS." WHERE id_user = $id_user";

	// armazena resultado da consulta:
	$result = mysqli_query($conn, $sql);

	// bolleana que definirá se o usuário logado receberá uma atualização de seguidores ou não
	$go_to_update = false; // inicialmente não prosseguirá com a atualização

	// se a consulta foi bem-sucedida
	if(mysqli_affected_rows($conn) > 0){

		// transforma resultado em um array associativo?
		$collum_id_followers = mysqli_fetch_assoc($result);

		// string recebe valor armazenado no array associatvo criado
		$ids_string = $collum_id_followers['id_followers'];

		// array criado a partir da string, onde a ',' é o caracter que indica que uma nova posição do array será criado, e $ids_string indica a string que está sendo convertida em array: 
		$ids_array = explode(",", $ids_string);

		// recebe posição (índice) específica do array, onde o valor indicado por $id_follower exista dentro do array $ids_array
		$key = array_search($id_follower, $ids_array);

		// apaga a posição indicada por $key (e valor associado a ela) do array $ids_array
		unset($ids_array[$key]);

		// converte novamente um array em uma string, sendo que agora, a "," será o separador de elementos 
		$ids_string = implode(",", $ids_array);

		// pode prosseguir com a atualização
		$go_to_update = true;

	}

	// se for possivel prosseguir com a atualização:
	if($go_to_update){

		// cria o comando de update
		$sql = "UPDATE ". USERS . " set id_followers = '$ids_string' WHERE id_user = $id_user";

		// armazena o resultado do comando
		$result = mysqli_query($conn, $sql);

		// se o comando foi executado corretamente
		if(mysqli_affected_rows($conn) > 0){
			// inicia a seção para que seja possível atualizar os usuários seguidos
			if(!isset($_SESSION)){
				session_start();
			}
			$_SESSION['id_followers'] = $ids_string;

			// deixou de seguir o usuário
			return true;
		}else{
			// erro ao deixar de seguir usuário
			return false;
		}
	
	}else{
		// não foi encontrado o usuário que deseja deixar de seguir
		return false;
	}


}

/* 	função: get_followers
	descrição: 
		retorna os ids de todos os usuários que o usuário logado segue
	parâmetos:
		$id_user: id do usuário logado
	retornos: 
		$ids: os ids dos usuários que se segue, em uma string
		null: nulo se não foi possível realizar a consulta
 */
function get_followers($id_user){

	// recebe a conexãp
	$conn = get_connection();

	// consulta que será realizada na tabela especificada
	$sql = "SELECT id_followers FROM ".USERS." WHERE id_user = $id_user";

	// recebe o resultado da consulta realziada
	$result = mysqli_query($conn, $sql);

	// se a consulta foi bem-sucedida
	if(mysqli_affected_rows($conn) > 0){
		// transforma resultado em um array associatio
		$followers = mysqli_fetch_assoc($result);
		// armazena valor do array em uma string
		$ids = $followers['id_followers'];
		// retorna a string com os ids todos
		return $ids;
	}else{
		// retorna nulo se a cosulta a tabela resultou em erro
		return null;
	}
}
	

/* 	função: register_new_user
	descrição: 
		salva novo usuário na tabela de usuários
	parâmetos:
		$user_data: os dados do usuário que será salvo
		$img: nome da imagem de perfil
	retornos: 
		true: se foi adicionado usuáio com sucesso
		false: se houve erro ao adicionar usuário
 */
function register_new_user($user_data, $img){


	$conn = get_connection();
	$sql = "INSERT INTO " . USERS . " (name, email, user_name, password, profile_img) VALUES ('".$user_data['name']."', '".$user_data['email']."', '".$user_data['user_name']."', '".$user_data['password']."', '".$img."')";

	$result = mysqli_query($conn, $sql);

	if(mysqli_affected_rows($conn)){

		return true;
	}else{

		return false;
	}


}

?>