<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Register</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

		<style type="text/css">

    body{
     background-image: url("img/imagem1.jpg");
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

    
    </style>
</head>
<body class="container-fluid">

	<?php 

	include 'menu.php';

	 ?>

	 <form name="form_cadastro" method="post" action="cadastrado.php" enctype="multipart/form-data">
	 	
	 	<p>
	 		<label for="name">Name:</label><br>
	 		<input type="text" name="name">
	 	</p>

	 	<p>
	 		<label for="email">E-mail:</label><br>
	 		<input type="email" name="email">
	 	</p>

	 	<p>
	 		<label for="user_name">User:</label><br>
	 		<input type="text" name="user_name">
	 	</p>

	 	<p>
	 		<label for="passowrd">Password:</label><br>
	 		<input type="password" name="password">
	 	</p>

	 	<p>
	 		<label for="profile_img">Profile picture:</label><br>
	 		<input type="file" name="profile_img">
	 	</p>

	 	<button class="btn btn-success btn-rounded" type="submit">Register</button>

	 </form>


</body>
</html>