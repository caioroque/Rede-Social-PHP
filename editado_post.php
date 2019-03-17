<?php include 'functions/DBGateway.php'; ?>
<?php include 'functions/postsDAO.php';

if(!empty($_POST['id_post']) && !empty($_POST['the_post'])){

	$id_post  = $_POST['id_post'];
	$the_post = $_POST['the_post'];
	$date     = date('d/m/Y, g:i a');

	$conn = get_connection();

	$sql = "UPDATE tb_posts SET the_post = '$the_post', date = '$date'
			WHERE id_post = $id_post";

	$result = mysqli_query($conn, $sql);

		if(mysqli_affected_rows($conn) > 0){

			header('location:gerenciar.php?msg=editarOk');
		}else{

			header('location:gerenciar.php?msg=editarError');
		}

	}else{

		header('location:gerenciar.php?msg=editarError');
	}


 ?>