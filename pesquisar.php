<?php include_once 'functions/util.php'; lock_page(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Search </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<style type="text/css">

    body{
     background-image: url("img/imagem3.jpg");
    }

    button{

     width: 140px;
     height: 35px;

    }

     input{

     width: 185px;
     height: 35px;
     background-color: #FFFFFF;
     border-radius: 10px 20px;
}

    p{
          color: #FFFFFF;
     }

     label{
          color: #FFFFFF;
     }

    h2{
     color: #FFFFFF;
    }

    textarea{
     width: 185px;
     height: 35px;
     background-color: #FFFFFF;
     border-radius: 10px 20px;
    }
    
    </style>
</head>
<body class="container-fluid">

	<?php include 'menu.php'; ?>

	<br>
	<p>
		<form name="pesquisar" action="pesquisar.php" method="get">

			<label for="search">Search by Name or Username:</label><br>
			<input type="text" name="search"> 
			<button type="submit" class="btn btn-info btn-sm">Search</button>
			
		</form>
	</p>


	<?php 

	include_once 'functions/userDAO.php';


	// recebe o retorno de get_followers
	// string contendo os ids dos seguidores OU nulo, caso o usuário não siga ninguém
	$followers = get_followers($_SESSION['id_user']);

	// se este retorno não for nulo
	if($followers != null){

		// converte a string 'followers' em um array 'ids'
		$ids = explode(",", $followers);

		// o usuário possui seguidores
		$has_followers = true;
	}else{
		// se o retorno for nulo:

		// o usuário NÃO segue ninguem
		$has_followers = false;
	}
		
		// se recebeu o paramento de pesquisa 'search' via GET
		if(!empty($_GET['search'])){

			$search = $_GET['search'];

			// '$result' irá receber o retorno da função 'search_user'
			/* parametros enviados: o termo da mesquisa, o nome do usuario logado e o nome de usuario do usuario logado

			possiveis retornos:
			nulo, se não existir usuários com o termo de pesquisa OU
			o resltado da pesquisa */
			$result = search_user($search, $_SESSION['name'], $_SESSION['user_name']);

			// se o retorno for diferente de nulo:
			if ($result != null){


				// trata msgs de retorno:
				if(!empty($_GET['msg'])){

					$msg = $_GET['msg'];


					if($msg == 'add_ok'){
						echo '<h3 class="alert alert-success">Seguidor adicionado ao seu feed!</h3>';
					
					}else if ($msg == 'add_error'){
						echo '<h3 class="alert alert-danger">Erro ao seguir usuário...</h3>';
					
					}else if ($msg == 'del_ok'){
						echo '<h3 class="alert alert-success">Seguidor removido do seu feed com sucesso!</h3>';
					
					}else if ($msg == 'del_error'){
						echo '<h3 class="alert alert-danger">Erro ao remover seguidor...</h3>';
					}

				}



				// mostra usuários encontrados:
				
				echo '<br><h3 class="text text-success">Usuários Encontrados</h3>';

				while ($user = mysqli_fetch_assoc($result)) {
					
					echo '<p>';
					echo $user['name'] . " (".$user['user_name'].") ";

					$already_following = false;
					if($has_followers){
						
						foreach ($ids as $value) {

							if($user['id_user'] == $value ){
								$already_following = true;
							}
						}
					}

						if(!$already_following){

							echo '<a href="follow.php?search='.$search.'&add_follower=true&id_follower='.$user['id_user'].'" class="btn btn-xs btn-info" ><span class="glyphicon glyphicon-plus"></span> Seguir</a>';
						}else{
							echo '<a href="unfollow.php?search='.$search.'&del_follower=true&id_follower='.$user['id_user'].'" class="btn btn-xs btn-danger" ><span class="glyphicon glyphicon-minus"></span> Deixar de Seguir</a>';
						}

					
					echo '</p>';

				}




			}else{
				echo '<h3 class="text text-warning">Não foram encontrados usuários com o termo '.$search."</h3>";
			}
		}


	 ?>


</body>
</html>
