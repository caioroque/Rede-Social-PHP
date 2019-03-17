<?php include 'functions/DBGateway.php'; ?>
<?php include 'functions/postsDAO.php';

if(!empty($_POST['id_user']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['user_name'])
	 && !empty($_POST['password']) && !empty($_POST['profile_img'])){

	$id_user      = $_POST['id_user'];
	$name         = $_POST['name'];
	$email        = $_POST['email'];
	$user_name    = $_POST['user_name'];
	$password     = $_POST['password'];
	$profile_img  = $_POST['profile_img'];

	$conn = get_connection();

	$sql = "UPDATE tb_users
			SET name = '$name', email = '$email',  user_name = '$user_name',  password = '$password',  profile_img = '$profile_img'
			WHERE id_user = $id_user";

	$result = mysqli_query($conn, $sql);

		if(mysqli_affected_rows($conn) > 0){

			header('location:perfil.php?msg=editarOk');
		}else{

			header('location:perfil.php?msg=editarError');
		}

	}else{

		header('location:perfil.php?msg=editarError');
	}


 ?>