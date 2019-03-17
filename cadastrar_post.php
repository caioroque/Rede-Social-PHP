<?php include 'functions/util.php'; lock_page(); ?>
<?php include 'functions/postsDAO.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<title>Say something</title>

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

     label{
          color: #000000;
     }

    h2{
     color: #FFFFFF;
    }

    b{
        color: #FFFFFF;
    }

    span{
        color: #FFFFFF;
    }

    
    </style>
</head>
<body class="container-fluid">

	<?php include 'menu.php' ;	

		
	?>

	<form name="cadpost" method="post" action="cadastrada_post.php" >

        <h2>Post</h2>

		<p>
			<label for="the_post"></label><br>
			<textarea name="the_post" data-ls-module="charCounter" maxlength="240" placeholder="What is thinking..."></textarea>
		</p>
        <b>Maximum of characters</b> 
        <span id="carater">240</span><br><br>

		<button name="postar" type="submit" class="btn btn-info btn-sm" >Post</button>

	</form>


</body>
</html>