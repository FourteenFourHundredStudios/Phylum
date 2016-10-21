<?php
	session_start() ;
	$_SESSION = array();
	setcookie("username", "",0);
	setcookie("password", "",0);
	//header("Cache-Control", "no-cache, no-store, must-revalidate");
	header( 'Location: /login.php?error=You were just logged out!' ) ;
?>
