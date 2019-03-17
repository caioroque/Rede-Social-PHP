<?php include 'functions/util.php'; lock_page();

	include 'functions/userDAO.php';


	if(!empty($_GET['del_follower'])){

		$id_follower = $_GET['id_follower'];
		$search = $_GET['search'];

		$result = del_follower($id_follower, $_SESSION['id_user']);

		if($result){
			header('location:pesquisar.php?search='.$search.'&msg=del_ok');
		}else{
			header('location:pesquisar.php?search='.$search.'&msg=del_error');
		}

	}else{
		header('location:pesquisar.php?search='.$search);
	}


?>