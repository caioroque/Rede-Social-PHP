<?php include 'functions/util.php'; lock_page(); ?>
<?php include 'functions/DBGateway.php';?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<title>Your Posts</title>

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


    tr{
     color: #FFFFFF;
    }

    th{
     color: #FFFFFF;
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
    
    </style>
</head>
<body class="container-fluid">

	<?php 


	// incluir arquivo de menu
	include 'menu.php';

	// incluir arquivo de conexão
	$conn = get_connection();

	$id_user = $_SESSION['id_user'];

	// cria o comando sql
	$sql = "SELECT id_post, the_post, date FROM tb_posts WHERE id_user = $id_user";

	// executa o comando sql e armazena o resultado em um variavel
	$result = mysqli_query($conn, $sql);

	// recebe o numero de linhas afetadas pelo comando sql no BD
	$linhas = mysqli_affected_rows($conn);

	// verifica se $linhas é maior do que zero:
	if($linhas > 0){

		// se verdadeiro:


		echo '<h2 >Noticias Cadastradas</h2>';
		echo '<table class="table">';
		echo '<tr>
				<th>ID #</th>
				<th>Notícia</th>
				<th>Data</th>
				<th>Editar</th>
				<th>Excluir</th>
			  </tr>';
		// cria um laço for para percorrer as linhas do array armazenado em 'result':
		for ($i=0; $i < $linhas; $i++) { 
			
			// a cada linha, extraimos seus dados como um array associativo
			// onde o nome do campo torna-se o indice o array
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
			// a cada registro, pula-se uma uma linha
			

			// editar:
			echo '<td><a href="editar_post.php?id_post='.$id_post.'" class="btn btn-warning btn-sm">Editar</a></td>';
			
			// excluir:
			echo '<td><a href="delete_post.php?id_post='.$id_post.'" class="btn btn-danger btn-sm" onclick="return confirm(\'Deseja realmente excluir este registro?\')">Excluir</a></td>';

			echo "</tr>"	;
		}
		echo '</form>';
		echo '</table>';




	}else{

		echo '<h2 >No news posted by you</h2>';

	}



	 ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>