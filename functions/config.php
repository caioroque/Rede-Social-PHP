<?php
// conexão com o BD
DEFINE ('DB', 'bd_social');
DEFINE ('SERVER', 'localhost');
DEFINE ('USER', 'root');
DEFINE ('PASSWORD', '');

// constantes das tabelas:]
DEFINE ('USERS', 'tb_users');
DEFINE ('POSTS', 'tb_posts');
DEFINE ('COMMENTS', 'tb_comments');



// consantes das páginas:
DEFINE ('HOME_OUT', 'index1.php');
DEFINE ('HOME', 'index.php');
DEFINE ('LOGIN', 'login.php');
DEFINE ('LOGOUT', 'logout.php');
DEFINE ('PROFILE', 'perfil.php');
DEFINE ('SEARCH', 'pesquisar.php');
DEFINE ('REGISTER', 'cadastrar.php');
DEFINE ('POST', 'cadastrar_post.php');
DEFINE ('MANAGER', 'gerenciar.php');

// constantes para imagem de perfil
DEFINE ('MAX_HEIGHT', 1000); // largura em pixels
DEFINE ('MAX_WIDTH', 1000); // altura em pixels
DEFINE ('MAX_SIZE', 2000000); // tamanho do arquivo em bytes
DEFINE ('IMG_PATH', 'imgs/fotos');

?>