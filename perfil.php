<?php include 'functions/util.php'; lock_page(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Profile</title>
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

     th{
          color: #FFFFFF;
     }

     tr{
          color: #FFFFFF;
     }

     label{
          color: #FFFFFF;
     }

    h2{
     color: #FFFFFF;
    }

    b{
    color: #FFFFFF;
    }
    
    </style>
</head>
<body class="container-fluid">

	<?php include 'menu.php'; ?>

	<?php 

	include 'functions/userDAO.php';

	include 'functions/postsDAO.php';

	$user_data['user_name'] = $_SESSION['user_name'];
	$user_data['password'] = $_SESSION['password'];

	$result = get_user($user_data);

	if ($result != null){

		$user = mysqli_fetch_assoc($result);

		foreach ($user as $indice => $valor) {
	
			if($indice != 'profile_img'){

				echo '<b>'.$indice.'</b>: ' .'<b>'. $valor .'</b>'.'<br>';
			}else{
				echo '<img src="imgs/fotos/'.$valor.'" class="img-responsive img-thumbnail" height="150px" width="150px"><br>';
			}


		}
		
		echo '<p>Clique <a href="editar_user.php"> aqui &nbsp</a>Para editar seus dados</p>';

	}else{
		echo '<h3 class="text text-danger">Erro ao carregar dados do usuário</h3>';
	}


	?>

	<?php 

	$conn = get_connection();

	$id_user = $_SESSION['id_user'];

	$sql = "SELECT id_post, the_post, date FROM tb_posts WHERE id_user = $id_user";

	$result = mysqli_query($conn, $sql);

	$linhas = mysqli_affected_rows($conn);

	if($linhas > 0){

		echo '<h2 >Seus Posts</h2>';
		echo '<table class="table">';
		echo '<tr>
				<th>ID #</th>
				<th>Notícia</th>
				<th>Data</th>
			  </tr>';

		for ($i=0; $i < $linhas; $i++) { 
			
			$noticias = mysqli_fetch_assoc($result);


			echo '<tr>';
			// percorre o array associativo gerado
			foreach ($noticias as $indice => $valor) {
				// mostra os valores de $indice e $valor na trla:
				echo "<td>" .  $valor . "</td>";

				// capturar o id_contato:
				if($indice == 'id_post'){
					$id_post = $valor;
				}

			}
		
			echo "</tr>";
		}
		echo '</form>';
		echo '</table>';

		echo '<p>Clique <a href="cadastrar_post.php"> aqui &nbsp</a>Para dizer algo</p>';

	}else{

		echo '<h2 >You do not have any posts</h2>';

	}



	 ?>


</body>
</html>