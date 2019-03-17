<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

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

     label{
          color: #FFFFFF;
     }

    h2{
     color: #FFFFFF;
    }

    </style>
</head>

<body class="container-fluid">

  <?php include 'menu.php'; ?>

  <h2 >Login </h2>
  <form name="entrar" action="login.php" method="post">
    
    <p>
      <label for="user_name">User:</label><br>
      <input type="text" name="user_name">
    </p>

    <p>
      <label for="password">Password:</label><br>
      <input type="password" name="password">
    </p>

    <button name="logar" type="submit" class="btn btn-info">Enter</button>

  </form>

  <?php 

    if($_POST){

      if(!empty($_POST['user_name']) && !empty($_POST['password'])){

        $user_data['user_name'] = $_POST['user_name'];
        $user_data['password']  = $_POST['password'];

        include_once 'functions/userDAO.php';

        $logado = validar_login($user_data);

        if($logado){
          // redireciona para pagina de perfil
          header('location:'.PROFILE);
        }else{
          // redireciona para pagina de login
        header('location:'.LOGIN.'?msg=login_invalid');
        }


      }else{

        header('location:'.LOGIN.'?msg=empty_fields');
      }

    }


   ?>

  
</body>
</html>
