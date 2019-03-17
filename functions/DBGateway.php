<?php
include_once 'config.php';

function get_connection(){

	$conn = new mysqli(SERVER, USER, PASSWORD, DB);
	return $conn;
}


?>