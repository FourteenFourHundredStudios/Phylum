<?php

	if(isset($_GET['error'])){
		header( 'Location: login.php?error='.$_GET['error'] ) ;
		die();
	}

	header( 'Location: login.php' ) ;
?>
