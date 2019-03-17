<?php include_once 'functions/util.php'; 
	verify_session(); 
	if(empty($_SESSION)){
?>

<ul class='nav nav-pills'>
	<li role="presentation"><a href="<?php echo HOME_OUT; ?>">Home</a></li>
		<li role="presentation"><a href="<?php echo REGISTER; ?>">Register</a></li>
	<li role="presentation"><a href="<?php echo LOGIN; ?>">Login</a></li>
</ul>
<?php

	}else{
?>
<ul class='nav nav-pills'>
	<li role="presentation"><a href="<?php echo HOME; ?>">Home</a></li>
	<li role="presentation"><a href="<?php echo SEARCH; ?>">Search friends</a></li>
	<li role="presentation"><a href="<?php echo MANAGER; ?>">Your Posts</a></li>
	<li role="presentation"><a href="<?php echo POST; ?>">Say somethings</a></li>
	<li role="presentation"><a href="<?php echo PROFILE; ?>">Profile</a></li>
	<li role="presentation"><a href="<?php echo LOGOUT; ?>">Logout</a></li>
</ul>
<?php
	}
?>