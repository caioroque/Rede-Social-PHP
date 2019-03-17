<?php 
// carrega noticias:

while($the_post = mysqli_fetch_assoc($result)){



	echo '<div class="post-id" id="'.$the_post['id_post'].'">';
	echo '<h3 class="text text-info">'.$the_post['the_post'].'</h3>';
	echo '<p>';
	echo substr($the_post['the_post'], 0, 20) . '[...] ';
	echo '<a href="detalhes.php?id_news='.$the_post['id_post'].'">Ver +</a>';
	echo '</p>';
	echo '</div>';

}

?>