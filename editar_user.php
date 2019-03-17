<?php require_once 'functions/util.php'; lock_page(); verify_session();?>

<?php require_once 'functions/postsDAO.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<title>Edit user</title>

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

    include 'functions/userDAO.php';


	if(isset($_GET['id_user'])){

	$id_user = $_GET['id_user'];
		
		$conn = get_connection();

	$sql = "SELECT id_user, name, email, user_name, password, profile_img
    FROM tb_users
    WHERE id_user = $id_user ";

		$result = mysqli_query($conn, $sql);

		$linhas = mysqli_affected_rows($conn);

		if($linhas > 0){

			$registro = mysqli_fetch_assoc($result);

			$name	       = $registro ['name'];
            $email         = $registro ['email'];
            $user_name     = $registro ['user_name'];
            $password      = $registro ['password'];
            $profile_img   = $registro ['profile_img'];

	?>

	<form name="edicao" action="editado_post.php" method="post">

		<label for="name">Name:</label><br>
		<input type="text" name="name"
		value="<?php echo $registro['name']; ?>"><br><br>

        <label for="email">E-mail:</label><br>
        <input type="text" name="email"
        value="<?php echo $registro['email']; ?>"><br><br>

        <label for="user_name">User:</label><br>
        <input type="text" name="user_name"
        value="<?php echo $registro['user_name']; ?>"><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" name="password"
        value="<?php echo $registro['password']; ?>"><br><br>

        <label for="profile_img">Profile picture:</label><br>
        <input type="file" name="profile_img"
        value="<?php echo $registro['profile_img']; ?>"><br><br>


	   <input type="hidden" name="id_user" 
	   value="<?php echo $registro['id_user']; ?>">

       <button name="editar" type="submit" class="btn btn-warning">Edit</button>
	
	</form>

	<?php
		}else{

			header('location:perfil.php?msg=editarError');
		}

	}else{

		header('location:perfil.php?msg=error');
	}
?>
</form>
</body>
</html>