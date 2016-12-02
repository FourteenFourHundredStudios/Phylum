<?php
include "cleanheader.php";
include_once('database.php'); 
date_default_timezone_set('America/Chicago');
$date=getdate()[0];
$id= $_GET['id'];
$comment= $_GET['c'];
$sql=
	"INSERT INTO `comments` 
		(`date`, `postid`, `username`, `comment`)
			VALUES 
		('{$date}', '{$id}','{$_SESSION['username']}', '{$comment}');";



$conn->query($sql);
?>