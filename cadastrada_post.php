<?php include 'functions/util.php'; lock_page();?>

<?php include 'functions/postsDAO.php';

	if(!empty($_POST['the_post'])){


		date_default_timezone_set('America/Sao_Paulo');

		$post_data['the_post']   = $_POST['the_post'];
		$post_data['data']    = date('d/m/Y, g:i a');
		$post_data['id_user'] = $_SESSION['id_user'];

		new_post($post_data);
		

	}else{

		header('location:cadastrar_post.php?msg=post_empty');
	}




?>