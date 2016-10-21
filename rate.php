<?php 
	include("header.php");
	rate($_GET["post"], $_GET["stars"]);
	//followToggle($_GET["user"],"followers");
//	echo $_GET["stars"];


	header("Location:feed.php");
?>
