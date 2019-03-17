<?php  

include_once 'DBGateway.php';

function get_posts($user_data){

	$conn = get_connection();

	$sql = "SELECT ".POSTS.".*, ".USERS.".user_name FROM " . POSTS . 
	" INNER JOIN ".USERS. " ON ".POSTS.".id_user = ".USERS.".id_user WHERE ".POSTS.".id_user IN (" . 
	$user_data['id_followers'].")";

	$result = mysqli_query($conn, $sql);

	if(mysqli_affected_rows($conn) > 0){
		return $result;
	}else{
		return null;
	}

}


function has_followers($id_user){

	$conn = get_connection();
	$sql = "SELECT * FROM ". USERS . " WHERE id_followers NOT LIKE '' AND id_user = " . $id_user;

	$result = mysqli_query($conn, $sql);

	if(mysqli_affected_rows($conn) > 0){
		return true;
	}else{
		return false;
	}
}

// retorna o número de notícias cadastradas:
function get_number_of_news(){

	$conn = get_connection();
	$sql = "SELECT * FROM tb_posts";
	$result = mysqli_query($conn, $sql);
	$number_of_news = mysqli_affected_rows($conn);
	return $number_of_news;
}

// retorna as notícias cadastradas:
function get_post(){

	$conn = get_connection();
	$sql = "SELECT * from tb_post 
	ORDER BY id_posts";
	$result = mysqli_query($conn, $sql);
	return $result;
}

// retorna notícia específica
function get_this_post($id_post){

	$conn = get_connection();
	$sql = "SELECT tb_posts.id_post, tb_posts.the_post, tb_posts.post_date, tb_users.user_name 
		FROM tb_posts
		INNER JOIN tb_users 
		ON tb_posts.id_user = tb_users.id_user
		WHERE tb_posts.id_post = $id_post";
	$result = mysqli_query($conn, $sql);
	return $result;
}

function delete_posts($id_post){

	$conn = get_connection();
	$sql = "DELETE FROM tb_posts WHERE id_post = $id_post";
	mysqli_query($conn, $sql);

	if(mysqli_affected_rows($conn) > 0){

		header('location:'.MANAGER.'?msg=delete_news_success');
	}else{

		header('location:'.MANAGER.'?msg=delete_news_error');
	}
}

function new_post($post_data){

	
	$conn = get_connection();

	$sql = "INSERT INTO tb_posts (the_post, date, id_user) VALUES 
		('".$post_data['the_post']."', '".$post_data['data']."', ".$post_data['id_user'].")";

	$result = mysqli_query($conn, $sql);

	if(mysqli_affected_rows($conn) > 0){

		header('location:perfil.php?msg=post_success');
	
	}else{
		header('location:cadastrar_post.php?msg=post_error');
	}

}



?>