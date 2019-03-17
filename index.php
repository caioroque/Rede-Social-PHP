<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Home</title>
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

    h3{
     color: #FFFFFF;
    }

    tr{
     color: #FFFFFF;
    }

    th{
     color: #FFFFFF;
    }

    b{
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

	<?php include 'menu.php';

	
	if(empty($_SESSION)){

		echo '<h2 class="text text-warning">Entre para ver seu feed!</h2>';
	}else{


		include_once 'functions/postsDAO.php';

		if(has_followers($_SESSION['id_user'])){

			$result = get_posts($_SESSION);

			if($result != null){

				echo '<h3 >What do you say?</h3>';

				while($post = mysqli_fetch_assoc($result)){


					echo '<b>'.$post['user_name'].'</b>'. '<b>'. '&nbsp'. 'disse em '.
					$post['date']. '</b>' . ":<br>";
					echo '<b>'. $post['the_post']. '</b>' . "<br><br>";

				}

			}else{

				echo '<h3>Seus amigos ainda não postaram nada!</h3>';

			}

		}else{
			echo '<h3>Você ainda não está seguindo nenhum amigo!</h3>';
		}

	}

	?>


</body>
</html>