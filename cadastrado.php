<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>HABLAR - Cadastre-se!</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body class="container">

	<?php include 'menu.php';

	include_once 'functions/userDAO.php';


	if($_POST){

		$user_data['name'] = $_POST['name'];
		$user_data['email'] = $_POST['email'];
		$user_data['user_name'] = $_POST['user_name'];
		$user_data['password'] = $_POST['password'];


		$profile_img['name'] = $_FILES['profile_img']['name'];
		$profile_img['type'] = $_FILES['profile_img']['type'];
		$profile_img['tmp_name'] = $_FILES['profile_img']['tmp_name'];
		$profile_img['error'] = $_FILES['profile_img']['error'];
		$profile_img['size'] = $_FILES['profile_img']['size'];

		include_once 'functions/util.php';

		//print_r($profile_img);
		$result = check_image($profile_img);


		if(!is_array($result)){

			if(register_new_user($user_data, $result)){

				$msg = '<h3 class="alert alert-success">Cadastro realizado com sucesso! Efetue login para começar a HABLAR!</h3>';

			}else{
				$msg = '<h3 class="alert alert-danger">Erro ao efetuar cadastro...</h3>';

			}


		}else{

			$msg = '<h3 class="alert alert-danger"><p><b>Foram encontrados erros ao tentar salvar sua imagem de perfil:</b></p><br>';
			foreach ($result as $key => $value) {
				$msg .= $value . "<br>";
			}
			$msg .= '</h3>';

		}

		echo $msg;


	}else{

		header('location:'.REGISTER);

	}




 ?>
</body>
</html>