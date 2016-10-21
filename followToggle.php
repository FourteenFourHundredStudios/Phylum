<?php 
	include("header.php");
	followToggle($_GET["user"]);
	//followToggle($_GET["user"],"followers");
	


	header("Location:feed.php?user=".$_GET["user"]);
?>