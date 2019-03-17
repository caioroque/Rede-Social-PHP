<?php include_once 'functions/postsDAO.php'; 

if(!empty($_GET['id_post'])){

	$id_post = $_GET['id_post'];

	delete_posts($id_post);


}else{

	header('location:gerenciar.php?msg=error');

}


?>