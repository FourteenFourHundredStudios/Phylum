<?php

	//clean header is all the regular header stuff, but no html
	session_start();
	if(!(isset($_SESSION['username']))){
		header('Location: index.php?error=You need to login to view this page') ;	
		die();	
	} 
	echo '<link rel="stylesheet" type="text/css" href="style.css">';

	include('database.php'); 
	
	include('userfunctions.php'); 
?>

<iframe frameborder="0" scrolling="no" style="width:0;height:0;opacity:100%" id="backgroundContent"></iframe>



<script type="text/javascript">


	function redirect(loc){
		window.location=loc;
	}

	function redirectTop(loc){
		window.top.location.href=loc;
	}
</script>