<?php require_once 'functions/util.php'; lock_page(); verify_session();?>
<?php require_once 'functions/postsDAO.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<title>Edit Post</title>

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

    tr{
     color: #FFFFFF;
    }

    th{
     color: #FFFFFF;
    }

    select{
     width: 185px;
     height: 35px;
     background-color: #FFFFFF;
     border-radius: 10px 20px;
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


<?php include 'menu.php'; 


	if(isset($_GET['id_post'])){

	$id_post = $_GET['id_post'];
		
		$conn = get_connection();

		$sql = "SELECT id_post, the_post
    FROM tb_posts
    WHERE id_post = $id_post ";

		$result = mysqli_query($conn, $sql);

		$linhas = mysqli_affected_rows($conn);

		if($linhas > 0){

			$registro = mysqli_fetch_assoc($result);

			$the_post	= $registro ['the_post'];

	?>

	<form name="edicao" action="editado_post.php" method="post">

		<label for="the_post">Post</label><br>
		<input type="text" name="the_post"
		value="<?php echo $registro['the_post']; ?>"><br><br>

	<input type="hidden" name="id_post" 
	value="<?php echo $registro['id_post']; ?>">

	<button name="editar" type="submit" class="btn btn-warning">Edit</button>
	
	</form>

	<?php
		}else{

			header('location:gerenciar.php?msg=editarError');
		}

	}else{

		header('location:gerenciar.php?msg=error');
	}
?>
</form>
</body>
</html>